# Autor: Alfonso Hernández Xochipa

FROM php:8.5.12-apache AS base

ENV TZ=America/Mexico_City

# OPcache no se instala: desde PHP 8.5 es parte del motor y viene activa.
RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        libonig-dev libzip-dev unzip git tzdata; \
    ln -snf "/usr/share/zoneinfo/$TZ" /etc/localtime; \
    echo "$TZ" > /etc/timezone; \
    docker-php-ext-install -j"$(nproc)" pdo pdo_mysql mysqli mbstring zip; \
    rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT=/var/www/html
COPY vhost.conf /etc/apache2/sites-available/000-default.conf
COPY php.ini /usr/local/etc/php/conf.d/zz-custom.ini

COPY --from=composer:2.8 /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html


# Etapa opcional. Si Xdebug aún no soporta PHP 8.5, falla solo esta etapa.
FROM base AS debug

RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY xdebug.ini /usr/local/etc/php/conf.d/zzz-xdebug.ini
