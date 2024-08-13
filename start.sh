#!/bin/bash

# Change to the src directory
cd /var/www/html/src

# Install dependencies
composer install

# Generate key
php artisan key:generate

# Start Apache
apache2-foreground