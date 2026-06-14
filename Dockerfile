FROM php:8.2-apache

# 1. Install dependensi sistem & ekstensi PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd zip

# 2. Aktifkan mod_rewrite untuk routing Apache
RUN a2enmod rewrite

# 3. Copy semua file projek
COPY . /var/www/html

# 4. Amankan file .env di dalam server Docker agar Laravel punya pegangan awal
RUN cp /var/www/html/.env.production /var/www/html/.env

# 5. Install Composer & dependensi vendor
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader

# 6. Bersihkan sisa cache lokal laptop secara paksa
RUN rm -f /var/www/html/bootstrap/cache/config.php \
    && rm -f /var/www/html/bootstrap/cache/services.php \
    && rm -f /var/www/html/bootstrap/cache/packages.php

# 7. Arahkan Apache ke folder public Laravel
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 8. Setel permission folder storage & cache secara total
RUN mkdir -p /var/www/html/storage/framework/cache/data \
    && mkdir -p /var/www/html/storage/framework/sessions \
    && mkdir -p /var/www/html/storage/framework/views \
    && mkdir -p /var/www/html/storage/logs \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Hapus EXPOSE 80, ganti dengan setelan port dinamis Apache
RUN sed -i 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf
RUN sed -i 's/<VirtualHost \*:80>/<VirtualHost \*:${PORT}>/g' /etc/apache2/sites-available/*.conf

CMD ["apache2-foreground"]