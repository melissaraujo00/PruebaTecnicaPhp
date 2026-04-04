<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;


$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env');

session_start();
require_once __DIR__ . '/../app/Config/config.php';
require_once APP_ROOT . '/Core/Database.php';
require_once APP_ROOT . '/Core/Model.php';
require_once APP_ROOT . '/Core/Controller.php';
require_once APP_ROOT . '/Core/App.php';

$app = new App();