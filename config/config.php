<?php

return [
    /*
     * Here goes your console application configuration. You should
     * define your application list of commands and your Laravel
     * Service Providers configuration.
     */
    'app' => [

        /*
         * Here goes the application name.
         */
        'name' => 'Laravel Zero Installer',

        /*
         * Here goes the application version.
         */
        'version' => '1.0.0',

        /*
         * If true, development commands won't be available as the app
         * will be in the production environment.
         */
        'production' => true,

        /*
         * Here goes the application list of commands.
         *
         * Besides the default command the user can also call
         * any of the commands specified below.
         */
        'commands' => [
            App\Commands\NewCommand::class,
        ],
    ],

    /*
     * Here goes the application cache configuration.
     *
     * You may want to review the Laravel supporter drivers in:
     * https://github.com/laravel/laravel/blob/master/config/cache.php
     */
    'cache' => [
        'default' => 'array',
        'stores' => [
            'array' => [
                'driver' => 'array',
            ],
        ],
    ],
];
