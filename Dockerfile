FROM php:8.2-apache

# 1. Install dependensi sistem & ekstensi PHP (Sudah ditambah libzip-dev dan zip)
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

# 2. Aktifkan mod_rewrite untuk routing Laravel
RUN a2enmod rewrite

# 3. Copy semua file projek
COPY . /var/www/html

# 4. Install Composer & dependensi vendor
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set ENV agar composer mengizinkan instalasi sebagai root/superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader

# 5. Arahkan Apache ke folder public Laravel (Menggunakan format baru agar tidak warning)
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 6. Setel permission folder storage & cache + paksa bikin folder logs
RUN mkdir -p /var/www/html/storage/logs \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

# Otomatis jalankan migrasi database saat container dinyalakan menggunakan format JSON args agar aman
CMD ["sh", "-c", "php artisan migrate --force && apache2-foreground"]