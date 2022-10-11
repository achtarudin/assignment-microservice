FROM php:8.0-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \ 
    curl \
    zip \
    unzip 

WORKDIR /var/www