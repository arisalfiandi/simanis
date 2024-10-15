FROM richarvey/nginx-php-fpm:1.9.0

COPY . .

# Set working directory
WORKDIR /var/www/html

# Install any PHP extensions needed
RUN docker-php-ext-install pdo pdo_mysql

# Set the appropriate permissions for the Apache server
RUN chown -R www-data:www-data /var/www/html

# Enable mod_rewrite for Apache
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
