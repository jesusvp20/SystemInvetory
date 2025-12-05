#!/bin/bash
set -e

echo "Iniciando aplicación Laravel..."

# Esperar a que la base de datos esté disponible
echo "Esperando a que la base de datos esté disponible..."
until php artisan migrate:status 2>/dev/null || [ $? -eq 1 ]; do
  echo "Base de datos no disponible - esperando..."
  sleep 2
done

echo "Base de datos disponible!"

# Ejecutar migraciones
echo "Ejecutando migraciones..."
php artisan migrate --force

# Limpiar y optimizar caché
echo "Optimizando aplicación..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Crear enlace simbólico de storage si no existe
if [ ! -L public/storage ]; then
    echo "Creando enlace simbólico de storage..."
    php artisan storage:link
fi

echo "Aplicación lista!"

# Iniciar Apache
exec apache2-foreground
