#!/usr/bin/env bash
sudo apt-get update && sudo apt-get install -y php-cli unzip curl
curl -sS https://getcomposer.org/installer | php
php composer.phar install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan storage:link
