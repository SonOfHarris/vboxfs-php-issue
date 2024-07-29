#!/usr/bin/env bash

# This will install correctly as files are downloaded directly
echo ""
echo "Installing from downloaded packages"
echo "-----------------------------------"
if [[ -d vendor ]]; then
  rm -Rf vendor
fi
composer clear-cache
composer install

# This will fail as certain packages are installed from cache
echo
echo "Installing from cache"
echo "---------------------"
rm -Rf vendor/bower-asset
composer install

# Testing additional behaviours
echo
echo "Testing alternatives (test.php)"
echo "-------------------------------"
php test.php
