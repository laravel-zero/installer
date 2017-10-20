<?php

return [
    'app' => [
        'name' => 'Laravel Zero Installer',
        'version' => '1.0.0',
        'production' => true,
        'commands' => [
            App\Commands\NewCommand::class,
        ],
    ],
    'cache' => [
        'default' => 'array',
        'stores' => [
            'array' => [
                'driver' => 'array',
            ],
        ],
    ],
];
