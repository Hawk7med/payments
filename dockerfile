FROM php:8.1-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    default-mysql-client

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html/src

# Copy existing application directory contents
COPY ./src /var/www/html/src

# Copy existing application directory permissions
COPY --chown=www-data:www-data ./src /var/www/html/src

# Change current user to www
USER www-data

# Expose port 80 and start apache server
EXPOSE 80
CMD ["apache2-foreground"]