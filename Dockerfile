# Build stage for Composer dependencies
FROM composer:2 as build
WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

COPY . .
RUN composer dump-autoload --optimize
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Production server stage using Apache
FROM php:8.2-apache

WORKDIR /var/www/html

# Enable Apache mod_rewrite for Laravel
RUN a2enmod rewrite

# Copy app files from build stage
COPY --from=build /app /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]