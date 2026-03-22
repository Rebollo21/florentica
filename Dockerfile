FROM php:8.2-fpm

# 1. Instalar dependencias del sistema, drivers de Postgres y NODE.JS
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev libpq-dev zip unzip \
    && curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# 2. Instalar extensiones de PHP (pdo_pgsql es la llave para Render)
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# 3. Traer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Configurar carpeta de trabajo y copiar archivos
WORKDIR /var/www
COPY . .

# 5. Instalar dependencias de PHP (Laravel)
RUN composer install --no-dev --optimize-autoloader

# 6. Instalar dependencias de JS y COMPILAR los estilos (Vite)
# Esto es lo que quita el error de "Manifest not found"
RUN npm install && npm run build

# 7. Arrancar el servidor
CMD php artisan serve --host=0.0.0.0 --port=$PORT