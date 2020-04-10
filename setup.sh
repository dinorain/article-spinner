#!/bin/bash

folder_name="${PWD##*/}"

# Go back one step
cd ..

# Update local package index
apt update

# Install Composer
apt install curl php-cli php-mbstring git unzip -y
curl -sS https://getcomposer.org/installer -o composer-setup.php
php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Install nodejs
curl -sL https://deb.nodesource.com/setup_10.x -o nodesource_setup.sh
bash nodesource_setup.sh
apt install nodejs -y
apt install build-essential -y

# Install Yarn
curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list
apt update -y
apt install yarn -y

# Move files to /var/www
pwd && mv $folder_name /var/www -v

echo project files moved to /var/www/$folder_name
