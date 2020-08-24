FROM php:7.2-apache

RUN apt-get update && apt-get install -y \
        curl \
        wget \
        git \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libicu-dev \
    && pecl install mcrypt-1.0.1 \
    && docker-php-ext-install -j$(nproc) iconv mbstring \
    && docker-php-ext-enable mcrypt

RUN a2enmod rewrite headers

WORKDIR /var/www
