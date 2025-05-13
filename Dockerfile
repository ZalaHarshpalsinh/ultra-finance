# Use an official PHP image with Apache
FROM php:8.2-apache

# Copy your PHP files into the container
COPY . /var/www/html/ultra-finance/.

# (Optional) Install PHP extensions if needed (e.g., for MySQL)
RUN docker-php-ext-install mysqli

# Expose port 80 (default for Apache)
EXPOSE 80