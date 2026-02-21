FROM php:8.2-fpm-alpine

# 1. Instalación de dependencias del sistema
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
    curl \
    nodejs \
    npm \
    nginx

# 2. Instalación de extensiones PHP
RUN docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_pgsql \
    gd \
    bcmath \
    zip \
    soap

# Configuración de PHP-FPM
RUN sed -i 's|listen = .*|listen = 0.0.0.0:9000|' /usr/local/etc/php-fpm.d/www.conf

# 3. Traer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 2. Copia tu configuración de Nginx al contenedor
COPY ./nginx/default.conf /etc/nginx/http.d/default.conf

# 4. Copiar archivos de dependencias primero (Optimiza el tiempo de build)
COPY composer.json composer.lock package.json package-lock.json ./

# 5. Copiar el resto del código
COPY . .

# 6. Instalar dependencias de PHP (sin scripts para evitar fallos si no hay código aún)
RUN composer install --no-interaction --no-dev --no-scripts --no-autoloader


# 7. Finalizar Composer e instalar/compilar assets de Node
# Aquí es donde se soluciona automáticamente el error de Vite
RUN composer dump-autoload --optimize \
    && npm install \
    && npm run build

# -----------------------------------------------------------
# 8. AJUSTE DE PERMISOS (Corregido)
# -----------------------------------------------------------
# Creamos la carpeta build por si npm no la creó, y asignamos dueños y permisos
RUN mkdir -p /var/www/html/public/build \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/build \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/build

EXPOSE 9000

# 9. Script de entrada
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]