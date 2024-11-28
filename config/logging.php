<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

return function ($app) {
    // Configuração do Logger
    $app['logger'] = function () {
        $logger = new Logger('app');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/app.log', Logger::DEBUG));
        return $logger;
    };
};
