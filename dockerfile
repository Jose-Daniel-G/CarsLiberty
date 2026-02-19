FROM php:8.2-fpm-alpine

# 1. Instalar dependencias del sistema
# ERROR CORREGIDO: Tenías "apk add" repetido dentro de la misma lista.
# También agregamos 'postgresql-dev', que es necesario para compilar pdo_pgsql en Alpine.
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

# 2. Instalar extensiones de PHP
# Agregamos 'pdo' explícitamente por buena práctica, aunque suele venir por defecto.
RUN docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql pdo_pgsql bcmath zip soap

# 3. Copiar Composer desde la imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Directorio de trabajo
WORKDIR /var/www/html

# 5. Copiar el código del proyecto
COPY . .

# 5.1 INSTALAR DEPENDENCIAS DE COMPOSER (Añade esto aquí)
# Usamos --no-dev para producción y optimizamos el autoload
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 6. Permisos para Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 7. Exponer el puerto que Render espera (10000 por defecto)
EXPOSE 10000

# 8. Comando de inicio "Monolito" para Render
# Esto corre las migraciones y levanta el servidor integrado de PHP que SÍ entiende HTTP.
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000

# CMD ["php-fpm"]