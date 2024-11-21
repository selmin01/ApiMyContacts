<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


// Verifica se a API está rodando
$app->get('/api/health', function () {
    return new Response(json_encode(['status' => 'API is running']), 200, ['Content-Type' => 'application/json']);
});
$app->get('/api/person', 'Controllers\PersonController::getAllPerson');
$app->post('/api/person', 'Controllers\PersonController::createPerson');

