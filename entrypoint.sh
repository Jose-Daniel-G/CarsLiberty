#!/bin/sh

echo "🚀 Starting Laravel..."

# Esperar DB
until php artisan migrate:status > /dev/null 2>&1
do
  echo "⏳ Waiting for database..."
  sleep 3
done

echo "📦 Running migrations..."
php artisan migrate --force

echo "🧹 Caching config..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "🎯 Starting main process..."
exec "$@"