FROM php:8.0-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \ 
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip 

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \ 
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql \
    && docker-php-ext-enable pdo_mysql pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer config -g -- disable-tls true

# WORKDIR /var/www/app-auth

# COPY src/app-auth .

# ENTRYPOINT [ "composer", "install", "--ignore-platform-reqs" ]