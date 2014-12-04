<?php

return [
    'debug' => true,

    // 'mysql.options' => [
    //     'user' => 'root',
    //     'pass' => '',
    //     'db'   => 'database'
    // ]

    'swiftmailer.options' => [
        'disable_delivery' => getenv('env') ?: 'dev',
        // 'host' => 'host',
        // 'port' => '25',
        // 'username' => 'username',
        // 'password' => 'password',
        // 'encryption' => null,
        // 'auth_mode' => null
    ]
];
