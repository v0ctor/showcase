## Base image
FROM php:7.3-fpm AS base

WORKDIR /app

COPY docker/app/opcache-runtime.ini $PHP_INI_DIR/conf.d/opcache.ini

# PHP extensions and their dependencies:
#  - gmp (libgmp-dev)
#  - intl (libicu-dev)

RUN mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini \
    && sed -i 's/expose_php = .*/expose_php = Off/' $PHP_INI_DIR/php.ini \
    && mkdir -p /run/php \
    && printf "listen = /run/php/php.sock\nlisten.mode = 0666\n" >> /usr/local/etc/php-fpm.d/zz-docker.conf \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        libgmp-dev \
        libicu-dev \
        locales \
        unzip \
    && sed -i '/\(ca_ES\|es_ES\|en_US\).UTF-8/s/^# //g' /etc/locale.gen \
    && locale-gen \
    && docker-php-ext-install \
        gmp \
        intl \
        opcache \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*


## Builder image
FROM base AS builder

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini \
    && sed -i 's/memory_limit = .*/memory_limit = 256M/' $PHP_INI_DIR/php.ini

COPY docker/app/opcache-development.ini $PHP_INI_DIR/conf.d/opcache.ini

COPY --from=composer /usr/bin/composer /usr/bin


## Development image
FROM builder AS development

ENV PS1='\u@\h:\w\\$ '
ENV PATH="${PATH}:/app/vendor/bin:/app/node_modules/.bin"
ENV PHP_IDE_CONFIG='serverName=default'

ARG USER_ID=1000
ENV USER_NAME=app

COPY docker/app/xdebug.ini $PHP_INI_DIR/conf.d

RUN useradd --user-group --create-home --shell /bin/bash --uid $USER_ID $USER_NAME \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        curl \
        gnupg2 \
    && curl -sL https://deb.nodesource.com/setup_8.x | bash - \
    && apt-get install -y --no-install-recommends \
        nodejs \
    && npm install --global \
        npm \
    && pecl install \
        xdebug-2.7.0beta1 \
    && docker-php-ext-enable \
        xdebug \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*


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


## Runtime image
FROM base AS runtime

COPY --from=installer /app /app
COPY --from=assets /app/public /app/public
