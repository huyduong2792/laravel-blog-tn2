# Use the official PHP 7.4 image as base
FROM php:8.2-fpm

# Install dependencies for Laravel and Node.js
RUN apt-get update && apt-get install -y \
    libmcrypt-dev \
    mariadb-client \
    libzip-dev \
    zip \
    curl \
    unzip \
    git \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    nodejs \
    npm \
    gnupg

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY ./src /var/www

# Install PHP dependencies
# RUN composer install

# Install Yarn
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
    && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list \
    && apt-get update && apt-get install -y yarn

# Install Node.js dependencies
# RUN yarn install && yarn build

# RUN php artisan key:generate
# RUN php artisan migrate

# Run seeders
# RUN php artisan db:seed

# Expose port 8000 and start php-fpm server
EXPOSE 8000