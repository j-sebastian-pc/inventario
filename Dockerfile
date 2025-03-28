# Imagen base de PHP con extensiones necesarias
FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    curl \
    git \
    zip \
    && docker-php-ext-install pdo pdo_mysql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar archivos del proyecto
WORKDIR /var/www
COPY . /var/www

# Asigna permisos correctos
RUN chown -R www-data:www-data /var/www

# Exponer el puerto 9000
EXPOSE 9000
