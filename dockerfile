FROM php:8.2-apache AS base

RUN docker-php-ext-install pdo pdo_mysql mysqli \
    && a2enmod rewrite

WORKDIR /var/www/html

FROM base AS test
COPY . /var/www/html/
RUN php -l index.php && php -l health.php

FROM base AS production
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80