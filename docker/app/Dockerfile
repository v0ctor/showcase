FROM debian:stretch-slim

# Environment
WORKDIR "/var/www"

ENV DEBIAN_FRONTEND noninteractive
ENV TEMPORARY apt-transport-https curl

# Dependencies
RUN apt-get update && \
    apt-get -y upgrade && \
	apt-get -y --no-install-recommends install apt-utils && \
	apt-get -y --no-install-recommends install $TEMPORARY ca-certificates gcc git gnupg2 locales

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
	php7.1-fpm \
	php7.1-curl \
	php7.1-gmp \
	php7.1-intl \
	php7.1-mbstring \
	php7.1-mysql \
	php-redis \
	php7.1-xml \
	php7.1-zip

ADD pool.conf /etc/php/7.1/fpm/pool.d/z-overrides.conf

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Node
RUN curl -sL https://deb.nodesource.com/setup_6.x | bash - && \
	apt-get -y --no-install-recommends install nodejs && \
	npm install --global npm gulp-cli

# Cleanup
RUN apt-get -y remove $TEMPORARY && \
	apt-get -y autoremove && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Daemon
CMD /usr/sbin/php-fpm7.1 -F -O 2>&1 | sed -u 's,.*: \"\(.*\)$,\1,'| sed -u 's,"$,,' 1>&1
