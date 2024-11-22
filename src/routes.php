<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Verifica se a API está rodando
$app->get('/api/health', function () {
    return new Response(json_encode(['status' => 'API is running']), 200, ['Content-Type' => 'application/json']);
});

// $app->get('/api/docs', function () use ($app) {
//     // Scaneia apenas o diretório 'src/Swagger'
//     try {
//         $swagger = \OpenApi\Generator::scan([__DIR__ . '/Swagger']);
//         header('Content-Type: application/json');
//         echo $swagger->toJson();
//     } catch (\Exception $e) {
//         echo 'Error: ' . $e->getMessage();
//     }
// });

// $app->get('/swagger-ui', function () {
//     return new Symfony\Component\HttpFoundation\RedirectResponse('/swagger-ui/index.html');
// });

$app->get('/api/person', 'Controllers\PersonController::getAllPerson');
$app->post('/api/person', 'Controllers\PersonController::createPerson');

