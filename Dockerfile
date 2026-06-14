FROM php:8.2-cli

# 1. Install dependensi sistem & ekstensi PHP yang dibutuhkan Laravel
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

# 2. Set folder kerja utama
WORKDIR /var/www/html

# 3. Copy semua file projek
COPY . /var/www/html

# 4. Amankan file .env cadangan agar Laravel punya pegangan awal
RUN cp /var/www/html/.env.production /var/www/html/.env

# 5. Install Composer & dependensi vendor
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader

# 6. Bersihkan sisa cache lokal laptop secara paksa
RUN rm -f /var/www/html/bootstrap/cache/config.php \
    && rm -f /var/www/html/bootstrap/cache/services.php \
    && rm -f /var/www/html/bootstrap/cache/packages.php

# 7. Setel permission folder storage & cache
RUN mkdir -p /var/www/html/storage/framework/cache/data \
    && mkdir -p /var/www/html/storage/framework/sessions \
    && mkdir -p /var/www/html/storage/framework/views \
    && mkdir -p /var/www/html/storage/logs \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 8. Jalankan internal web server Laravel langsung ke PORT dinamis Railway
CMD php artisan serve --host=0.0.0.0 --port=${PORT}