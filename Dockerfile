# -----------------------------
# 1️⃣ Stage Builder (Node + Composer)
# -----------------------------
FROM node:20-alpine AS node_builder

WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run build


FROM composer:2 AS composer_builder

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction
COPY . .
RUN composer dump-autoload --optimize


# -----------------------------
# 2️⃣ Stage Final (Producción limpia)
# -----------------------------
FROM php:8.2-fpm-alpine

RUN apk update && apk upgrade --no-cache \
    && apk add --no-cache \
    postgresql-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev

RUN docker-php-ext-install pdo pdo_pgsql gd bcmath zip soap

WORKDIR /var/www/html

# Copiamos solo lo necesario
COPY --from=composer_builder /app /var/www/html
COPY --from=node_builder /app/public/build /var/www/html/public/build

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# 🔥 ENTRYPOINT
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 9000

ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm"]