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

# 4. Publicar assets de Administración y crear carpetas faltantes
echo "🎨 Publicando assets de la administración..."
# Forzamos la instalación de assets de AdminLTE para que existan en public/vendor
php artisan adminlte:install --only=assets --force
# Creamos la carpeta de favicons para evitar el 404 del log
mkdir -p /var/www/html/public/favicons

# 5. Enlace de Storage (Instrucción guardada: soluciona visualización de imágenes)
echo "🔗 Generando enlace simbólico de storage..."
php artisan storage:link --force

# 6. CORRECCIÓN MASIVA DE PERMISOS (Vital para evitar el Error 500)
echo "🔐 Corrigiendo permisos para www-data..."
chown -R www-data:www-data /var/www/html/storage \
                         /var/www/html/bootstrap/cache \
                         /var/www/html/public
chmod -R 775 /var/www/html/storage \
             /var/www/html/bootstrap/cache \
             /var/www/html/public

# 7. Limpieza de caché
echo "🧹 Limpiando caché..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 8. Configuración de Nginx y arranque
mkdir -p /run/nginx
echo "📡 Iniciando Nginx en el puerto 10000..."
nginx -g "daemon on;"

# 9. Ejecutar Build de Vite (Instrucción guardada: soluciona ViteManifestNotFoundException)
# Aunque suele estar en el Dockerfile, ponerlo aquí asegura que los archivos existan antes de arrancar FPM
echo "📦 Compilando assets de Vite..."
npm run build

echo "🎯 Iniciando PHP-FPM..."
exec php-fpm