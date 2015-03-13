<?php

return [
    'monolog.logfile' => __DIR__.'/../storage/debug.log',
    'twig.path'       => __DIR__.'/../views',
    'twig.options'    => [
        'cache' => __DIR__.'/../storage/cache',
    ],
];
