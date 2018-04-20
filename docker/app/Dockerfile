FROM debian:stretch-slim

# Environment
WORKDIR "/var/www"

ARG USER_ID
ARG USER_NAME

ENV DEBIAN_FRONTEND noninteractive
ENV TEMPORARY apt-transport-https curl

# Dependencies
RUN apt-get update && \
    apt-get -y upgrade && \
    apt-get -y --no-install-recommends install apt-utils && \
    apt-get -y --no-install-recommends install $TEMPORARY ca-certificates gcc gnupg2 iproute locales

# Default user
RUN useradd --user-group --create-home --shell /bin/bash --uid $USER_ID $USER_NAME

# Locales
RUN sed -i '/ca_ES.UTF-8/s/^# //g' /etc/locale.gen && \
    sed -i '/en_US.UTF-8/s/^# //g' /etc/locale.gen && \
    sed -i '/es_ES.UTF-8/s/^# //g' /etc/locale.gen && \
    ln -s /etc/locale.alias /usr/share/locale/locale.alias && \
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
    php-xdebug \
    php7.2-xml \
    php7.2-zip

ADD production.ini /etc/php/7.2/cli/conf.d/99-overrides.ini
ADD production.ini /etc/php/7.2/fpm/conf.d/99-overrides.ini
ADD pool.conf /etc/php/7.2/fpm/pool.d/z-overrides.conf

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    echo 'export PATH=$PATH:/var/www/vendor/bin' >> ~/.bashrc && \
    su -c "echo 'export PATH=$PATH:/var/www/vendor/bin' >> ~/.bashrc" $USER_NAME

# Xdebug
RUN echo "xdebug.remote_host=`ip route | awk '/default/ { print $3 }'`" >> /etc/php/7.2/cli/conf.d/20-xdebug.ini && \
    echo "xdebug.remote_host=`ip route | awk '/default/ { print $3 }'`" >> /etc/php/7.2/fpm/conf.d/20-xdebug.ini && \
    echo 'export PHP_IDE_CONFIG="serverName=default"' >> ~/.bashrc && \
    su -c "echo 'export PHP_IDE_CONFIG=\"serverName=default\"' >> ~/.bashrc" $USER_NAME

# Node
RUN curl -sL https://deb.nodesource.com/setup_8.x | bash - && \
    apt-get -y --no-install-recommends install nodejs && \
    npm install --global npm gulp-cli

# Cleanup
RUN apt-get -y remove $TEMPORARY && \
    apt-get -y autoremove && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Daemon
CMD /usr/sbin/php-fpm7.2 -F -O 2>&1 | sed -u 's,.*: \"\(.*\)$,\1,'| sed -u 's,"$,,' 1>&1
