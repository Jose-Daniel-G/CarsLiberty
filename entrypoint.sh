#!/bin/sh

echo "🚀 Iniciando aplicación Laravel..."

# 1. Esperar conexión segura a Postgres (con SSL para Render)
until php -r "
try {
    \$h = getenv('DB_HOST');
    \$u = getenv('DB_USERNAME');
    \$p = getenv('DB_PASSWORD');
    \$db = getenv('DB_DATABASE');
    \$port = getenv('DB_PORT') ?: '5432';

    echo \"Probando conexión con Usuario: \$u en Host: \$h \n\";

    \$dsn = \"pgsql:host=\$h;port=\$port;dbname=\$db;sslmode=require\";
    new PDO(\$dsn, \$u, \$p);
    exit(0);
} catch (Exception \$e) {
    echo '❌ Error de conexión: ' . \$e->getMessage() . PHP_EOL;
    exit(1);
}"
do
    echo "⏳ Reintentando conexión en 5 segundos..."
    sleep 5
done

echo "✅ Base de datos lista!"

# 2. Migraciones
echo "📦 Ejecutando migraciones..."
php artisan migrate --force

# 3. Seeders Inteligentes
echo "🌱 Verificando si es necesario ejecutar seeders..."
if php artisan tinker --execute="echo \App\Models\TipoVehiculo::where('tipo', 'sedan')->count();" | grep -q '0'; then
    echo "🚀 Datos no encontrados. Ejecutando seeders..."
    php artisan db:seed --force
else
    echo "✅ Los datos ya existen. Saltando seeders."
fi

# 4. Publicar assets y ejecutar Build de Vite (ANTES de los permisos)
echo "🎨 Publicando assets de la administración..."
php artisan adminlte:install --only=assets --force
mkdir -p /var/www/html/public/favicons

echo "📦 Compilando assets de Vite..."
npm run build

# 5. Enlace de Storage
echo "🔗 Generando enlace simbólico de storage..."
php artisan storage:link --force

# 6. CORRECCIÓN MASIVA DE PERMISOS (Vital para quitar el 500 y 502)
echo "🔐 Corrigiendo permisos para www-data..."
chown -R www-data:www-data /var/www/html/storage \
                         /var/www/html/bootstrap/cache \
                         /var/www/html/public
chmod -R 775 /var/www/html/storage \
             /var/www/html/bootstrap/cache \
             /var/www/html/public

# 7. Optimización de producción (Cambio de clear a cache)
echo "🧹 Optimizando caché de configuración..."
# php artisan config:cache
php artisan config:clear
php artisan cache:clear
php artisan route:cache
php artisan view:cache

# 8. Arranque de servicios
mkdir -p /run/nginx
echo "📡 Iniciando Nginx en el puerto 10000..."
nginx -g "daemon on;"

echo "🎯 Iniciando PHP-FPM..."
exec php-fpm