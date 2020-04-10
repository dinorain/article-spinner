#!/bin/bash

composer install

yarn

yarn run prod

composer dump-autoload
php artisan optimize
