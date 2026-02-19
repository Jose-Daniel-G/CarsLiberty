#!/bin/sh

echo "🚀 Iniciando aplicación Laravel..."

echo "⏳ Esperando conexión a la base de datos..."

until php artisan migrate --force > /dev/null 2>&1
do
  echo "⏳ Base de datos aún no lista... reintentando en 3 segundos..."
  sleep 3
done

echo "✅ Base de datos lista!"

echo "📦 Ejecutando migraciones..."
php artisan migrate --force

echo "🎯 Iniciando PHP-FPM..."
exec php-fpm
