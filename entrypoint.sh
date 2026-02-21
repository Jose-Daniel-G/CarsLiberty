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

# 3. Seeders Inteligentes (Evita el error Unique Violation)
echo "🌱 Verificando si es necesario ejecutar seeders..."
# Cambiamos la lógica para detectar si ya existe el tipo 'sedan' en la tabla tipos_vehiculos
if php artisan tinker --execute="echo \App\Models\TipoVehiculo::where('tipo', 'sedan')->count();" | grep -q '0'; then
    echo "🚀 Datos no encontrados. Ejecutando seeders..."
    php artisan db:seed --force
else
    echo "✅ Los datos ya existen. Saltando seeders para evitar errores de duplicidad."
fi

# 4. CORRECCIÓN CRÍTICA DE PERMISOS (Soluciona el Error 500)
echo "🔐 Corrigiendo permisos de storage y cache para www-data..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 5. Limpieza de caché
echo "🧹 Limpiando caché de configuración..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 6. Enlace de Storage (Instrucción guardada para imágenes)
echo "🔗 Generando enlace simbólico de storage..."
php artisan storage:link --force

echo "🎨 Publicando assets de la administración..."
php artisan adminlte:install --only=assets --force

# 7. Configuración de Nginx
mkdir -p /run/nginx

# 8. Iniciar Nginx en SEGUNDO PLANO
echo "📡 Iniciando Nginx en el puerto 10000..."
nginx -g "daemon on;"

# 9. Iniciar PHP-FPM en PRIMER PLANO
echo "🎯 Iniciando PHP-FPM..."
exec php-fpm