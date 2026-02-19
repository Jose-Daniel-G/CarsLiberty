FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    postgresql-dev \
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

RUN docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_pgsql \
    gd \
    bcmath \
    zip \
    soap

RUN sed -i 's|listen = .*|listen = 0.0.0.0:9000|' /usr/local/etc/php-fpm.d/www.conf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Optimización cache Docker
COPY composer.json composer.lock ./
RUN composer install --no-interaction --optimize-autoloader --no-dev

COPY . .

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 9000

COPY entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

CMD ["/entrypoint.sh"]
