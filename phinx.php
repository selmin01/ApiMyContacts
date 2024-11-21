<?php
return [
    'paths' => [
        'migrations' => 'migrations',
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => [
            'adapter' => 'mysql',
            'host' => '127.0.0.1',
            'name' => 'db_contacts',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
        ],
    ],
];
