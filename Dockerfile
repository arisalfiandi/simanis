# Use a newer version of the nginx-php-fpm image
FROM richarvey/nginx-php-fpm:1.9.0

# Set the working directory
WORKDIR /var/www/html

# Copy your application files
COPY . .

# Copy custom nginx configuration file
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Expose the port
EXPOSE 80