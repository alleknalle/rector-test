FROM php:8.2-fpm-alpine

RUN apk update && \
    apk add git yarn && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    chown -Rf www-data.www-data /var/www && \
    mkdir -p /opt/cache && \
    mkdir -p /opt/logs && \
    chown www-data:www-data /opt/logs && \
    chown www-data:www-data /opt/cache && \
    apk --no-cache add pcre-dev ${PHPIZE_DEPS} git openssh linux-headers icu-dev && \
    pecl install xdebug git && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl && \
    docker-php-ext-enable xdebug && \
    apk del pcre-dev ${PHPIZE_DEPS} && \
    mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

WORKDIR /var/www

EXPOSE 8000
CMD ["php-fpm"]