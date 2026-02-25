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

    // Comentado para local, activo en Render mediante 'prefer'
    // \$dsn = \"pgsql:host=\$h;port=\$port;dbname=\$db;sslmode=require\";

    \$dsn = \"pgsql:host=\$h;port=\$port;dbname=\$db;sslmode=prefer\";


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

# --- SECCIÓN DE DIAGNÓSTICO TEMPORAL ---
echo "🔍 DIAGNÓSTICO DE INICIO:"
echo "👤 Usuario actual: $(whoami)"
echo "🔑 ¿Tiene APP_KEY?: $(if [ -z "$APP_KEY" ]; then echo "NO"; else echo "SÍ"; fi)"
echo "👥 Permisos de storage:"
ls -ld /var/www/html/storage
echo "🔑 ¿Tiene APP_KEY Local o .env?: $(grep -q "APP_KEY=base64" .env && echo "SÍ" || echo "NO")"
# ---------------------------------------

# 2. Migraciones
echo "📦 Ejecutando migraciones..."
php artisan migrate --force

# 3. Ejecutar seeders siempre
echo "🌱 Ejecutando seeders..."
    php artisan db:seed --force || echo "⚠️ Algunos seeders fallaron, revisa los logs."

echo "👥 Usuarios en base:"
php artisan tinker --execute="echo \App\Models\User::count();"

echo "🔎 Usuario jose existe?:"
php artisan tinker --execute="echo \App\Models\User::where('email','jose.jdgo97@gmail.com')->exists() ? 'SI' : 'NO';"

php artisan tinker --execute="\$u = \App\Models\User::where('email','jose.jdgo97@gmail.com')->first(); if(\$u) { \$u->syncRoles(['admin']); echo '✅ Rol Admin Sincronizado'; }"

echo "🛡️ Verificando permisos del usuario Jose..."
php artisan tinker --execute="\$u = \App\Models\User::where('email','jose.jdgo97@gmail.com')->first(); if(\$u) { \$u->assignRole('admin'); echo '✅ Rol Admin asignado a Jose\n'; echo '🔑 Permisos: ' . implode(', ', \$u->getAllPermissions()->pluck('name')->toArray()); } else { echo '❌ Usuario no encontrado para asignar rol'; }"

echo "🔑 Password hash:"
php artisan tinker --execute="echo \App\Models\User::where('email','jose.jdgo97@gmail.com')->first()->password;"

echo "🧪 Usuarios después del seed:"
php artisan tinker --execute="echo \App\Models\User::all();"

# 4. Publicar assets y ejecutar Build de Vite (ANTES de los permisos)
echo "🎨 Publicando assets de la administración..."
php artisan adminlte:install --only=assets --force

echo "📦 Compilando assets de Vite..."
npm run build

# 5. Enlace de Storage
echo "🔗 Generando enlace simbólico de storage..."
php artisan storage:link --force

# 6. CORRECCIÓN MASIVA DE PERMISOS (Vital para quitar el 500 y 502)
echo "🔐 Corrigiendo permisos para www-data..."
chown -R www-data:www-data /var/www/html/storage \
                         /var/www/html/bootstrap/cache \
                         /var/www/html/public \
                         /var/www/html/vendor
chmod -R 775 /var/www/html/storage \
             /var/www/html/bootstrap/cache \
             /var/www/html/public \
             /var/www/html/vendor

# 7. Optimización de producción (Cambio de clear a cache)
echo "🧹 Optimizando caché de configuración..."
# php artisan config:cache
php artisan config:clear
php artisan cache:clear
# Intentar cachear, pero no detener el proceso si falla (por ahora)
php artisan route:cache || echo "⚠️ Advertencia: No se pudieron cachear las rutas por duplicados."
php artisan view:cache


# 8. Arranque de servicios en Render, esto solo pasa en render
if [ "$NODE_ENV" = "production" ] || [ "$RENDER" = "true" ]; then
    echo "🌐 Entorno de Producción detectado (Render)..."
    mkdir -p /run/nginx
    echo "📡 Iniciando Nginx en el puerto 10000..."
    nginx -g "daemon on;"
else
    echo "🏠 Entorno Local detectado. Nginx interno saltado."
fi

# 8. Arranque de servicios
# RENDER (Comentado para local porque usas un contenedor Nginx separado):
# mkdir -p /run/nginx
# echo "📡 Iniciando Nginx en el puerto 10000..."
# nginx -g "daemon on;"

# echo "🎯 Iniciando PHP-FPM..."
# exec php-fpm

# Cambia la última línea por esto:
echo "🎯 Iniciando PHP-FPM en modo red..."
exec php-fpm -R -d listen=9000