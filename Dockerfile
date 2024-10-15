FROM richarvey/nginx-php-fpm:1.9.0

COPY . .

# Set working directory
WORKDIR /var/www/html

# Install any PHP extensions needed
RUN docker-php-ext-install pdo pdo_mysql

# Set the appropriate permissions for the Apache server
RUN chown -R www-data:www-data /var/www/html

# Start Apache server
CMD ["apache2-foreground"]
