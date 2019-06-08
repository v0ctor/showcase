## Base image
FROM php:7.3.6-fpm AS base

WORKDIR /app

COPY chart/files/app/php.ini $PHP_INI_DIR/conf.d/php.ini
COPY chart/files/app/opcache-runtime.ini $PHP_INI_DIR/conf.d/opcache.ini
COPY chart/files/app/fpm.conf /usr/local/etc/php-fpm.d/zz-docker.conf

# PHP extensions and their dependencies:
#  - gmp (libgmp-dev)
#  - intl (libicu-dev)

RUN mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini \
 && rm /usr/local/etc/php-fpm.d/docker.conf \
 && mkdir -p /run/php \
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

COPY --from=composer:1.8.5 /usr/bin/composer /usr/local/bin


## Development image
FROM builder AS development

ENV PS1='\u@\h:\w\\$ '
ENV PATH="${PATH}:/app/vendor/bin:/app/node_modules/.bin"
ENV PHP_IDE_CONFIG='serverName=default'

ARG USER_ID=1000
ENV USER_NAME=showcase

COPY chart/files/app/opcache-development.ini $PHP_INI_DIR/conf.d/opcache.ini
COPY chart/files/app/xdebug.ini $PHP_INI_DIR/conf.d

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini \
 && apt-get update \
 && apt-get install -y --no-install-recommends \
        curl \
        gnupg2 \
 && curl -sL https://deb.nodesource.com/setup_10.x | bash - \
 && apt-get install -y --no-install-recommends \
        nodejs \
 && npm install --global \
        npm \
 && pecl install \
        xdebug-2.7.2 \
 && docker-php-ext-enable \
        xdebug \
 && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
 && useradd --user-group --create-home --shell /bin/bash --uid $USER_ID $USER_NAME


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
FROM node:10.16.0-alpine AS assets

WORKDIR /app

ENV PATH="${PATH}:/app/node_modules/.bin"

COPY --from=installer /app /app

RUN npm ci \
 && gulp build


## Runtime image
FROM base AS runtime

COPY --from=installer /app /app
COPY --from=assets /app/public /app/public
