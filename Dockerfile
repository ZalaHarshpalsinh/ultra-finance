# Use an official PHP image with Apache
FROM php:8.2-apache

# Copy your PHP files into the container
COPY . /var/www/html/ultra-finance/.

# (Optional) Install PHP extensions if needed (e.g., for MySQL)
RUN docker-php-ext-install mysqli

# Enable output buffering and adjust session settings
RUN echo "output_buffering = On" >> /usr/local/etc/php/conf.d/custom.ini && \
        echo "session.auto_start = 0" >> /usr/local/etc/php/conf.d/custom.ini

# Expose port 80 (default for Apache)
EXPOSE 80