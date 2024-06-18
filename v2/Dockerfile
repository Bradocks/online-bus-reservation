# Use an official PHP runtime as a parent image with Apache
FROM php:7.4-apache

# Set working directory
WORKDIR /var/www/html

# Copy the PHP scripts into the directory
COPY . /var/www/html/

# Change ownership to the www-data user and group (Apache's user)
RUN chown -R www-data:www-data /var/www/html

# Ensure all files are readable and directories are accessible
RUN find /var/www/html -type d -exec chmod 755 {} \; && find /var/www/html -type f -exec chmod 644 {} \;

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Expose port 80 to access Apache
EXPOSE 80

# Use the default Apache configuration
CMD ["apache2-foreground"]
