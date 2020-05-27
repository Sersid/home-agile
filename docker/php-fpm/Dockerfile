FROM php:7.4-fpm

RUN apt-get update && apt-get install -y wget git unzip  \
    && apt-get install --yes --no-install-recommends libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN wget https://getcomposer.org/installer -O - -q \
    | php -- --install-dir=/bin --filename=composer --quiet

WORKDIR /var/www
