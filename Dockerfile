## Base image
FROM php:7.2-fpm-alpine AS base

WORKDIR /app

COPY docker/app/opcache-production.ini $PHP_INI_DIR/conf.d/opcache.ini

# PHP extensions and their dependencies:
#  - gmp (gmp-dev)
#  - intl (icu-dev)

RUN mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini \
    && mkdir -p /run/php \
    && printf "listen = /run/php/php.sock\nlisten.mode = 0666\n" >> /usr/local/etc/php-fpm.d/zz-docker.conf \
    && apk add --no-cache \
        gmp-dev \
        icu-dev \
    && docker-php-ext-install \
        gmp \
        intl \
        opcache


## Builder image
FROM base AS builder

COPY --from=composer /usr/bin/composer /usr/bin


## Development image
FROM builder AS development

ENV PS1='\u@\h:\w\\$ '
ENV PATH="${PATH}:/app/vendor/bin:/app/node_modules/.bin"
ENV PHP_IDE_CONFIG='serverName=default'

ARG USER_ID=1000
ENV USER_NAME=app

COPY docker/app/opcache-development.ini $PHP_INI_DIR/conf.d/opcache.ini
COPY docker/app/xdebug.ini $PHP_INI_DIR/conf.d

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini \
    && adduser -D -s /bin/bash -u $USER_ID $USER_NAME \
    && apk add --no-cache \
        $PHPIZE_DEPS \
        bash \
        nodejs \
        npm \
    && npm install --global \
        npm \
    && pecl install \
        xdebug \
    && docker-php-ext-enable \
        xdebug \
    && apk del \
        $PHPIZE_DEPS


## Installer image
FROM builder AS installer

COPY . /app

RUN composer install \
        --no-dev \
        --classmap-authoritative \
        --no-suggest \
        --no-progress \
    && ./artisan view:cache \
    && ./artisan lang:js


## Assets image
FROM node:8-alpine AS assets

WORKDIR /app

COPY --from=installer /app /app

RUN npm install --global \
        gulp-cli \
        npm \
    && npm ci \
    && gulp build


## Final image
FROM base AS final

COPY --from=installer /app /app
COPY --from=assets /app/public /app/public
