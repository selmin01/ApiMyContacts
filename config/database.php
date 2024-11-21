<?php
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

$config = new Configuration();
$connectionParams = [
    'dbname' => 'db_contacts',
    'user' => 'root',
    'password' => '',
    'host' => '127.0.0.1',
    'driver' => 'pdo_mysql',
];
$app['db'] = DriverManager::getConnection($connectionParams, $config);
