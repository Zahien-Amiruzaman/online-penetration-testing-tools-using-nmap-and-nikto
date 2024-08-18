

# PHP runtime version 8.2
FROM php:8.2-apache

# Enable Apache modules
RUN a2enmod rewrite

# Install extensions
RUN apt-get update && apt-get install -y tzdata && docker-php-ext-install mysqli pdo pdo_mysql

# Set the timezone
RUN ln -snf /usr/share/zoneinfo/Asia/Kuala_Lumpur /etc/localtime && echo "Asia/Kuala_Lumpur" > /etc/timezone

# Install extension 
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set the default working directory
WORKDIR /var/www/html

# Copy the source code in /www into the container at /var/www/html
COPY ../www .


