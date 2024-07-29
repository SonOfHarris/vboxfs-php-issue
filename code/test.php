<?php

$source = '/home/vagrant/.cache/composer/files/bower-asset/jquery-emoji-picker/6fd49d01393936f6fb934ab359f3f3f0ad96c865.zip';
$dest = getcwd() . '/test.zip';

error_reporting(E_ALL);

set_error_handler(
    function ($errno, $errstr) {
        echo "ERROR: {$errno} {$errstr}" . PHP_EOL;
    }
);

function compare_copied_file($source, $dest)
{
    echo "source: " . implode("\t", [md5_file($source), filesize($source), $source]) . PHP_EOL;
    echo "dest:   " . implode("\t", [md5_file($dest), filesize($dest), $dest]) . PHP_EOL;
}

echo PHP_EOL . 'copy()' . PHP_EOL;
copy($source, $dest);
compare_copied_file($source, $dest);

echo PHP_EOL . 'stream_copy_to_stream()' . PHP_EOL;
$sp = fopen($source, 'r');
$dp = fopen($dest, 'w+');
stream_copy_to_stream($sp, $dp);
fclose($sp);
fclose($dp);
compare_copied_file($source, $dest);

echo PHP_EOL . 'fwrite()' . PHP_EOL;
$sp = fopen($source, 'r');
$dp = fopen($dest, 'w+');
while (!feof($sp)) {
    fwrite($dp, fread($sp, 1024 * 1024));
}
fclose($sp);
fclose($dp);
compare_copied_file($source, $dest);

echo PHP_EOL . 'cp via passthru()' . PHP_EOL;
$exitCode = null;
passthru(
    'cp -v ' . escapeshellarg($source) . ' ' . escapeshellarg($dest),
    $exitCode
);
compare_copied_file($source, $dest);
