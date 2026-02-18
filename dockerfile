FROM php:8.2-fpm-alpine

# 1. Install system dependencies
RUN apk add --no-cache \
    $PHPIZE_DEPS \
    linux-headers \
    libzip-dev \
    zlib-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev \
    git \
    unzip \
    curl

# 2. Install PHP extensions
RUN docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) pdo_mysql bcmath zip soap

# 3. Copy Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Set working directory
WORKDIR /var/www/html

# 5. COPY YOUR CODE (This is the missing step that caused your error!)
# This moves your Laravel files into the container so the next command finds them
COPY . .

# 6. Set proper permissions for Laravel
# Now that the files are copied, these directories actually exist
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]