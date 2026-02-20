#!/bin/sh

echo "🚀 Iniciando aplicación Laravel..."

echo "⏳ Esperando conexión a la base de datos..."

# # Esperar hasta que la base de datos esté lista usando herramientas de Postgres
# until pg_isready -h db -p 5432 -U root
# do
#   echo "⏳ Postgres aún no responde... reintentando en 3 segundos..."
#   sleep 3
# done

# Esperar hasta que la base de datos esté lista usando PHP
until php -r "new PDO('pgsql:host=db;port=5432;dbname=cars_liberty', 'root', 'admin123');" > /dev/null 2>&1
do
  echo "⏳ Base de datos aún no lista (esperando conexión PDO)..."
  sleep 3
done

echo "✅ Base de datos lista!"

# Ejecutar migraciones
echo "📦 Ejecutando migraciones..."
php artisan migrate --force

# Ejecutar seeders
echo "🌱 Ejecutando seeders..."
php artisan db:seed --force

# 3. Solución de errores de acceso (Tu petición)
echo "🧹 Limpiando caché de configuración y rutas..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 4. Enlace de Storage (Fundamental para ver imágenes)
echo "🔗 Generando enlace simbólico de storage..."
php artisan storage:link --force

# Iniciar PHP-FPM
echo "🎯 Iniciando PHP-FPM..."
exec php-fpm
