# syntax=docker/dockerfile:1
FROM php:8.2-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev curl gnupg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Optimize layer caching by copying composer files first
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-scripts --prefer-dist --no-dev --optimize-autoloader || true

# Copy application code
COPY . .

# Ensure dependencies and permissions
RUN composer install --no-interaction --prefer-dist
# Create storage and cache directories if they don't exist (copy may exclude them)
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
