#!/bin/sh

echo "🚀 Iniciando aplicación Laravel..."

# # Esperar hasta que la base de datos esté lista usando herramientas de Postgres
# until pg_isready -h db -p 5432 -U root
# do
#   echo "⏳ Postgres aún no responde... reintentando en 3 segundos..."
#   sleep 3
# done

# # Esperar hasta que la base de datos esté lista usando PHP
# until php -r "new PDO('pgsql:host=db;port=5432;dbname=cars_liberty', 'root', 'admin123');" > /dev/null 2>&1
# do
#   echo "⏳ Base de datos aún no lista (esperando conexión PDO)..."
#   sleep 3
# done

# # 1. Esperar conexión segura a Postgres (con SSL para Render)
# until php -r "try { new PDO('pgsql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_DATABASE') . ';sslmode=require', getenv('DB_USERNAME'), getenv('DB_PASSWORD')); exit(0); } catch (Exception \$e) { exit(1); }"
# do
#   echo "⏳ Esperando conexión segura a Postgres en Render..."
#   sleep 3
# done

# until php -r "
# try {
#     \$dsn = 'pgsql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_DATABASE') . ';sslmode=require';
#     new PDO(\$dsn, getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
#     exit(0);
# } catch (Exception \$e) {
#     echo '❌ Error de conexión: ' . \$e->getMessage() . PHP_EOL;
#     exit(1);
# }"
# do
#   echo "⏳ Reintentando conexión..."
#   sleep 5
# done

until php -r "
try {
    \$h = getenv('DB_HOST');
    \$u = getenv('DB_USERNAME');
    \$p = getenv('DB_PASSWORD');
    \$db = getenv('DB_DATABASE');
    \$port = getenv('DB_PORT') ?: '5432';

    echo \"Probando con Usuario: \$u en Host: \$h \n\";

    \$dsn = \"pgsql:host=\$h;port=\$port;dbname=\$db;sslmode=require\";
    new PDO(\$dsn, \$u, \$p);
    exit(0);
} catch (Exception \$e) {
    echo '❌ Error Detallado: ' . \$e->getMessage() . PHP_EOL;
    exit(1);
}"
do
  echo "⏳ Reintentando en 5 segundos..."
  sleep 5
done

echo "✅ Base de datos lista!"

# 2. Migraciones y Seeders
echo "📦 Ejecutando migraciones..."
php artisan migrate --force

# echo "🌱 Ejecutando seeders..."
# php artisan db:seed --force

echo "🌱 Verificando si es necesario ejecutar seeders..."
# Comprobamos si la tabla de usuarios (o la que prefieras) tiene datos
if [ $(php artisan tinker --execute="echo \App\Models\User::count();") -eq 0 ]; then
    echo "🚀 La base de datos está vacía. Ejecutando seeders..."
    php artisan db:seed --force
else
    echo "✅ Ya existen datos en la base de datos. Saltando seeders para evitar duplicados."
fi

# Asegurar permisos justo antes de arrancar
echo "🔐 Corrigiendo permisos de storage y cache..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 3. Limpieza de caché (Asegura que se lea el .env de Render)
echo "🧹 Limpiando caché..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 4. Enlace de Storage (Instrucción guardada: para que las imágenes funcionen)
echo "🔗 Generando enlace simbólico de storage..."
php artisan storage:link --force

# 5. Configuración necesaria para Nginx en Alpine
mkdir -p /run/nginx

# 6. Iniciar Nginx en SEGUNDO PLANO
echo "📡 Iniciando Nginx en el puerto 10000..."
nginx -g "daemon on;"

# 7. Iniciar PHP-FPM en PRIMER PLANO (esto mantiene el contenedor vivo)
echo "🎯 Iniciando PHP-FPM..."
exec php-fpm