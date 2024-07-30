<?php

// This will install correctly as files are downloaded directly
echo PHP_EOL;
echo "Installing from downloaded packages" . PHP_EOL;
echo "-----------------------------------" . PHP_EOL;
if (file_exists('vendor')) {
    passthru('rm -Rf vendor');
}
passthru('composer clear-cache');
passthru('composer install');

// This will fail as certain packages are installed from cache
echo PHP_EOL;
echo "Installing from cache" . PHP_EOL;
echo "---------------------" . PHP_EOL;
passthru('rm -Rf vendor/bower-asset');
passthru('composer install');

// Testing additional behaviours
echo PHP_EOL;
echo "Testing alternatives (test.php)" . PHP_EOL;
echo "-------------------------------" . PHP_EOL;
require 'test.php';
