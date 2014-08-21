<?php
require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpKernel\Debug\ErrorHandler;
use Symfony\Component\HttpKernel\Debug\ExceptionHandler;

ini_set('display_errors', 1);
error_reporting(-1);
ErrorHandler::register();

if ('cli' !== php_sapi_name()) {
    ExceptionHandler::register();
}

require_once __DIR__.'/app/start.php';
