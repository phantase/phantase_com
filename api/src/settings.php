<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Twig settings
        'twig' => [
            'template_path' => __DIR__ . '/../twig/templates/',
            'cache_path' => __DIR__ . '/../twig/cache/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Database settings
        'db' => [
            'host' => 'db',
            'user' => 'phantacom',
            'pass' => 'pH1983',
            'dbname' => 'phantacom',
            'charset' => 'utf8',
        ],
    ],
];
