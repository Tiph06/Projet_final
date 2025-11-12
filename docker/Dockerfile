FROM php:8.3-fpm-alpine

# Paquets système + extensions PHP nécessaires à Laravel + SQLite
RUN apk add --no-cache bash git shadow sqlite sqlite-dev $PHPIZE_DEPS \
    && docker-php-ext-configure pdo_sqlite \
    && docker-php-ext-install -j$(nproc) pdo pdo_sqlite bcmath opcache

# Installer Composer dans l'image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# On copie le code (les fichiers seront ensuite montés par le volume)
COPY . /var/www

# Permissions pour Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
