# Use an official PHP runtime as the base image
FROM php:7.4-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Copy your PHP application files to the container
COPY . .

# Install any PHP extensions or dependencies your app requires
# For example, if you need MySQL support:
# RUN docker-php-ext-install mysqli pdo pdo_mysql

# Expose the port your Apache server will listen on (usually 80)
EXPOSE 80

# Define environment variables if needed
# ENV VARIABLE_NAME=value

# Start the Apache web server
CMD ["apache2-foreground"]
