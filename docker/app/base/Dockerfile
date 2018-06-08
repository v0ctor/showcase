FROM debian:stretch-slim

# Environment
WORKDIR "/var/www"

ENV DEBIAN_FRONTEND noninteractive
ENV TEMPORARY curl

# Dependencies
RUN apt-get update && \
    apt-get -y upgrade && \
	apt-get -y --no-install-recommends install apt-utils && \
	apt-get -y --no-install-recommends install \
	    $TEMPORARY \
	    apt-transport-https \
	    ca-certificates \
	    gcc \
	    gnupg2 \
	    locales

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
        php7.2-xml \
        php7.2-zip

RUN mkdir /run/php && \
    echo "[www]\nlisten.mode = 0777" >> /etc/php/7.2/fpm/pool.d/z-overrides.conf

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    echo 'export PATH=$PATH:/var/www/vendor/bin' >> ~/.bashrc

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
