<?php
require_once 'config/config.php';

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/lib/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});