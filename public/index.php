<?php

// api-silex/
// ├── config/
// │   ├── config.php        # Configurações gerais
// │   ├── database.php      # Configurações do banco de dados
// ├── public/
// │   └── index.php         # Arquivo de entrada
// ├── src/
// │   ├── Controllers/      # Controladores
// │   ├── Models/           # Modelos
// │   └── Services/         # Serviços (opcional)
// ├── migrations/           # Arquivos de migrations do Phinx
// ├── composer.json
// └── phinx.php             # Configuração do Phinx

require_once __DIR__ . '/../vendor/autoload.php';

use Silex\Application;

$app = new Application();
$app['debug'] = true;

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';

// Registre os headers globais
$headersMiddleware = require __DIR__ . '/../config/headers.php';
$headersMiddleware($app);

// // Configuração de logs
// $loggingConfig = require __DIR__ . '/../config/logging.php';
// $loggingConfig($app);

require_once __DIR__ . '/../src/routes.php';

// Exemplo de log inicial

$app->run();





// // web/index.php
// require_once __DIR__.'/../vendor/autoload.php';

// $app = new Silex\Application();

// $app->get('/hello/{name}', function ($name) use ($app) {
//     return 'Hello '.$app->escape($name);
// });

// $app->run();