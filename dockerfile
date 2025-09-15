FROM php:8.2-fpm-alpine

# Instalar dependencias necesarias
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

# Instalar extensiones de PHP
RUN docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) pdo_mysql bcmath zip soap

# Copiar Composer desde la imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir directorio de trabajo
WORKDIR /var/www/html

EXPOSE 9000
