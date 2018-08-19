## Base image
FROM debian:stretch-slim AS base

# Environment
WORKDIR "/var/www"

ENV DEBIAN_FRONTEND noninteractive

# Dependencies
RUN apt-get update && \
    apt-get -y upgrade && \
	apt-get -y --no-install-recommends install apt-utils && \
	apt-get -y --no-install-recommends install \
	    apt-transport-https \
	    ca-certificates \
	    curl \
	    gnupg2 \
	    locales \
	    unzip

# Locales
RUN sed -i '/ca_ES.UTF-8/s/^# //g' /etc/locale.gen && \
    sed -i '/en_US.UTF-8/s/^# //g' /etc/locale.gen && \
	sed -i '/es_ES.UTF-8/s/^# //g' /etc/locale.gen && \
	locale-gen

# PHP
RUN curl -sS https://packages.sury.org/php/apt.gpg | apt-key add - && \
    echo "deb https://packages.sury.org/php/ stretch main" > /etc/apt/sources.list.d/php.list && \
    apt-get update && \
    apt-get -y --no-install-recommends install \
        php7.2-fpm \
        php7.2-curl \
        php7.2-gmp \
        php7.2-intl \
        php7.2-mbstring \
        php7.2-mysql \
        php-redis \
        php7.2-xml \
        php7.2-zip

RUN mkdir /run/php && \
    echo "[www]\nlisten.mode = 0777" >> /etc/php/7.2/fpm/pool.d/z-overrides.conf

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    echo 'export PATH=$PATH:/var/www/vendor/bin' >> ~/.bashrc

# Cleanup
RUN apt-get -y autoremove && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Daemon
CMD /usr/sbin/php-fpm7.2 -F -O 2>&1 | sed -u 's,.*: \"\(.*\)$,\1,'| sed -u 's,"$,,' 1>&1


## Development image
FROM base AS development

# Arguments
ARG USER_ID=1000
ARG USER_NAME=showcase

# Dependencies
RUN apt-get update && \
	apt-get -y --no-install-recommends install \
	    iproute \
	    php-xdebug

# Default user
RUN useradd --user-group --create-home --shell /bin/bash --uid $USER_ID $USER_NAME

# PHP
COPY docker/app/config.development.ini /etc/php/7.2/cli/conf.d/99-overrides.ini
COPY docker/app/config.development.ini /etc/php/7.2/fpm/conf.d/99-overrides.ini

# Composer
RUN su -c "echo 'export PATH=$PATH:/var/www/vendor/bin' >> ~/.bashrc" $USER_NAME

# Xdebug
RUN echo 'xdebug.remote_host=host.docker.internal' >> /etc/php/7.2/mods-available/xdebug.ini && \
    echo 'export PHP_IDE_CONFIG="serverName=default"' >> ~/.bashrc && \
    su -c "echo 'export PHP_IDE_CONFIG=\"serverName=default\"' >> ~/.bashrc" $USER_NAME

# Node
RUN curl -sL https://deb.nodesource.com/setup_8.x | bash - && \
    apt-get -y --no-install-recommends install nodejs && \
    npm install --global npm gulp-cli

# Daemon
CMD ip route | awk '/default/ { print $3" host.docker.internal"}' >> /etc/hosts && \
    /usr/sbin/php-fpm7.2 -F -O 2>&1 | sed -u 's,.*: \"\(.*\)$,\1,'| sed -u 's,"$,,' 1>&1

# Cleanup
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*


## Builder image
FROM development AS builder

RUN gulp build


## Production image
FROM base AS production

# PHP
COPY docker/app/config.production.ini /etc/php/7.2/cli/conf.d/99-overrides.ini
COPY docker/app/config.production.ini /etc/php/7.2/fpm/conf.d/99-overrides.ini

# Application
COPY . /var/www

RUN composer install --classmap-authoritative --no-progress --no-suggest --no-dev && \
    php artisan route:cache

COPY --from=builder /var/www/public /var/www/public

# Cleanup
RUN rm /usr/local/bin/composer && \
    rm -r /root/.composer
