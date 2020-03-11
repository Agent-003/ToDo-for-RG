<?php
session_start();
ini_set('error_reporting', E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once "autoloader.php";

$app = new App\Application([
    'config' => __DIR__ . '/config/app.ini',
    'routes' => __DIR__ . '/config/routes.ini',
    'templates'=>__DIR__.'/templates'
]);

$result = $app->run();
