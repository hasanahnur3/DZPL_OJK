# Use pre-configured Nginx + PHP-FPM
FROM richarvey/nginx-php-fpm:3.1.6

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Allow composer to run inside container
ENV SKIP_COMPOSER 0
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel Environment Variables
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Ensure the `.env` file exists before generating APP_KEY
RUN if [ ! -f ".env" ]; then cp .env.example .env; fi

# Generate APP_KEY (if not set)
RUN php artisan key:generate || true

# Set correct permissions for Laravel storage
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Expose Nginx port
EXPOSE 80

# Start services
CMD ["/start.sh"]
