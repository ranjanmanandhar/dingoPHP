FROM php:8.2.24-fpm

# Install required dependencies for PHP
RUN apt-get update && apt-get install -y \
    mariadb-client libzip-dev \
    && docker-php-ext-install pdo_mysql zip

## Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY composer.lock composer.json /app/

COPY . .

RUN composer install

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]