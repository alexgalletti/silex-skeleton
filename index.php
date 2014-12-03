<?php
require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpKernel\Debug\ErrorHandler;
use Symfony\Component\HttpKernel\Debug\ExceptionHandler;

ini_set('display_errors', 1);
error_reporting(-1);
ErrorHandler::register();

if ('cli' !== substr(php_sapi_name(), 0, 3)) {
    ExceptionHandler::register();
    $app = require_once __DIR__.'/app/start.php';
} else {
    set_time_limit(0);
    $app = require_once __DIR__.'/app/console.php';
}

$app->run();
