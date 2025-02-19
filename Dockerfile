# Use official PHP image with Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    curl \
    git \
    && docker-php-ext-install pdo pdo_mysql gd mbstring

# Enable Apache mod_rewrite (important for Laravel)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy existing application files
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Clear & cache Laravel configurations
RUN php artisan config:clear && php artisan config:cache
RUN php artisan route:cache

# Run database migrations & storage link (fix for free-tier)
RUN php artisan migrate --force && php artisan storage:link || true

# Expose Apache port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
