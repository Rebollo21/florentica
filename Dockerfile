FROM php:8.2-fpm

# 1. Instalar dependencias, Postgres y Node.js para los estilos (Vite)
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev libpq-dev zip unzip \
    && curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# 2. Extensiones de PHP necesarias
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# 3. Traer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# 4. Arreglar permisos para que Render no bloquee carpetas
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# 5. Instalar Laravel y Compilar estilos (Vite)
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# 6. Comando para arrancar el servidor
CMD php artisan serve --host=0.0.0.0 --port=$PORT
