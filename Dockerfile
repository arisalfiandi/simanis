FROM php:8.1.0-apache

# Install dependencies
RUN apt-get update \
    && apt-get install -y nano zip unzip git libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy aplikasi CodeIgniter dari lokal ke container
COPY . /var/www/html

# Install dependencies dari composer
RUN composer install --no-dev --optimize-autoloader

# Setting ownership ke www-data (user Apache)
RUN chown -R www-data:www-data /var/www/html

# Copy konfigurasi Apache
COPY codeigniter.conf /etc/apache2/sites-available/

# Aktifkan site CodeIgniter dan reload Apache
RUN a2ensite codeigniter.conf \
    && service apache2 reload || true \
    && a2dissite 000-default.conf \
    && service apache2 reload || true

# Expose port 80
EXPOSE 80

CMD ["apache2-foreground"]