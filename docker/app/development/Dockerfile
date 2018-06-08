FROM victordzmr/showcase

# Arguments
ARG USER_ID
ARG USER_NAME

# Dependencies
RUN apt-get update && \
	apt-get -y --no-install-recommends install \
	    iproute \
	    php-xdebug

# Default user
RUN useradd --user-group --create-home --shell /bin/bash --uid $USER_ID $USER_NAME

# Composer
RUN su -c "echo 'export PATH=$PATH:/var/www/vendor/bin' >> ~/.bashrc" $USER_NAME

# Xdebug
RUN echo 'xdebug.remote_host=host.docker.internal' >> /etc/php/7.2/mods-available/xdebug.ini && \
    echo 'export PHP_IDE_CONFIG="serverName=default"' >> ~/.bashrc && \
    su -c "echo 'export PHP_IDE_CONFIG=\"serverName=default\"' >> ~/.bashrc" $USER_NAME

# Cleanup
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
