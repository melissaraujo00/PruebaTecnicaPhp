<?php


define('APP_ENV', getenv('APP_ENV') ?: 'development');
define('APP_URL', rtrim(getenv('APP_URL'), '/'));
define('APP_ROOT', dirname(__DIR__));         
define('PUBLIC_ROOT', APP_ROOT . '/../public');


define('DB_HOST', $_ENV['DB_HOST'] ?? '127.0.0.1');
define('DB_PORT', $_ENV['DB_PORT'] ?? '3306');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'facturasmart');
define('DB_USER', $_ENV['DB_USER'] ?? 'root');
define('DB_PASS', $_ENV['DB_PASS'] ?? '');


date_default_timezone_set(getenv('TIMEZONE') ?: 'America/El_Salvador');


if (APP_ENV === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}