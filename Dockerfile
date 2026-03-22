FROM php:8.2-fpm

# 1. Instalar TODO lo necesario (Postgres + Node.js para los estilos)
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev libpq-dev zip unzip \
    && curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# 2. Extensiones PHP
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# 3. Traer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# 4. Permisos de carpetas (Vital para Laravel)
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# 5. Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# 6. Compilar los estilos (Vite) - ¡Esto quita el error del Manifest!
RUN npm install && npm run build

# 7. Encender el servidor
CMD php artisan serve --host=0.0.0.0 --port=$PORT
