FROM php:8.1.0-apache

RUN apt-get update \
    && apt-get install -y nano zip unzip git libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Enable mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy semua file aplikasi ke dalam container
COPY . /var/www/html

# Set hak akses untuk folder public dan lain-lain
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Copy konfigurasi Apache
COPY codeigniter.conf /etc/apache2/sites-available/

# Aktifkan konfigurasi Apache dan nonaktifkan default
RUN a2ensite codeigniter.conf \
    && a2dissite 000-default.conf

# Restart Apache untuk mengaktifkan semua perubahan
RUN service apache2 reload

EXPOSE 80
CMD ["apache2-foreground"]