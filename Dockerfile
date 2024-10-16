FROM php:8.1.0-apache

RUN apt-get update \
    && apt-get install -y nano zip unzip git libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /var/www/html/public

# Copy aplikasi CodeIgniter dari lokal ke container
COPY . /var/www/html/public

RUN chown -R www-data:www-data /var/www/html/public \
    && composer self-update

# Copy konfigurasi Apache
COPY codeigniter.conf /etc/apache2/sites-available/

# Mengaktifkan site CodeIgniter dan menonaktifkan default, lalu restart Apache
RUN a2ensite codeigniter.conf \
    && a2dissite 000-default.conf \
    && apache2ctl configtest \
    && apache2ctl graceful

EXPOSE 80
CMD ["apache2-foreground"]