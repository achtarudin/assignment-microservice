FROM php:8.0-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \ 
    curl \
    zip \
    unzip 

RUN docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-enable pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer config -g -- disable-tls true

WORKDIR /var/www