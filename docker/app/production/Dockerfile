FROM victordzmr/showcase

# PHP
COPY docker/app/production/config.ini /etc/php/7.2/cli/conf.d/99-overrides.ini
COPY docker/app/production/config.ini /etc/php/7.2/fpm/conf.d/99-overrides.ini

# Application
COPY . /var/www

RUN composer install --classmap-authoritative --no-progress --no-suggest --no-dev && \
    php artisan config:cache && \
    php artisan route:cache

# Cleanup
RUN rm /usr/local/bin/composer && \
    rm /root/.composer
