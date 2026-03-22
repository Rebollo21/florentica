FROM php:8.2-fpm

# 1. Instalar dependencias, Postgres y Node.js 22 (La versión que pide Vite)
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev libpq-dev zip unzip \
    && curl -sL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

# 2. Extensiones PHP
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# 3. Traer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# 4. Arreglar permisos
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# 5. Instalar dependencias de PHP
RUN composer install --no-dev --optimize-autoloader

# 6. INSTALACIÓN DE JS (Limpiando errores previos)
# Borramos el lock viejo por si acaso y forzamos instalación limpia
RUN rm -rf package-lock.json node_modules \
    && npm install \
    && npm run build

# 7. Arrancar
CMD php artisan serve --host=0.0.0.0 --port=$PORT
