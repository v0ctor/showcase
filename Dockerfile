## Base image
FROM php:7.4.12-fpm AS base

COPY chart/files/server/php.ini $PHP_INI_DIR/conf.d/php.ini
COPY chart/files/server/opcache-runtime.ini $PHP_INI_DIR/conf.d/opcache.ini
COPY chart/files/server/fpm.conf /usr/local/etc/php-fpm.d/zz-docker.conf

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

COPY --from=composer:2.0.3 /usr/bin/composer /usr/local/bin


## Development image
FROM builder AS development

ENV PS1='\u:\w\\$ '
ENV PATH="${PATH}:/var/www/html/vendor/bin:/var/www/html/node_modules/.bin"
ENV PHP_IDE_CONFIG='serverName=default'

ARG USER_ID=1000
ENV USER_NAME=default

COPY chart/files/server/opcache-development.ini $PHP_INI_DIR/conf.d/opcache.ini
COPY chart/files/server/xdebug.ini $PHP_INI_DIR/conf.d

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini \
 && apt-get update \
 && apt-get install -y --no-install-recommends \
        curl \
        gnupg2 \
 && curl -sL https://deb.nodesource.com/setup_12.x | bash - \
 && apt-get install -y --no-install-recommends \
        nodejs \
 && npm install --global \
        npm \
 && pecl install \
        xdebug-2.9.8 \
 && docker-php-ext-enable \
        xdebug \
 && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
 && useradd --user-group --create-home --shell /bin/bash --uid $USER_ID $USER_NAME


## Installer image
FROM builder AS installer

COPY . .

RUN composer install \
        --no-dev \
        --classmap-authoritative \
        --no-suggest \
        --no-progress \
 && ./artisan view:cache \
 && ./artisan lang:js


## Assets image
FROM node:12.16.1-alpine AS assets

WORKDIR /var/www/html

ENV PATH="${PATH}:/var/www/html/node_modules/.bin"

COPY --from=installer /var/www/html .

RUN npm ci \
 && gulp build


## Runtime image
FROM base AS runtime

COPY --from=installer /var/www/html .
COPY --from=assets /var/www/html/public public
