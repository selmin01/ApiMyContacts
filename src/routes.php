<?php

use Symfony\Component\HttpFoundation\JsonResponse;

// Verifica se a API está rodando
$app->get('/api/health', function () {
    return new JsonResponse(['status' => 'API is running'], 200);
});

// // Rota para geração da documentação Swagger
// $app->get('/api/docs', function () use ($app) {
//     try {
//         // Scaneia apenas o diretório 'src/Swagger'
//         $swagger = \OpenApi\Generator::scan([__DIR__ . '/Swagger']);
//         return new JsonResponse(json_decode($swagger->toJson()), 200);
//     } catch (\Exception $e) {
//         return new JsonResponse(['error' => $e->getMessage()], 500);
//     }
// });

// Redireciona para a interface do Swagger UI
$app->get('/swagger-ui', function () {
    return new Symfony\Component\HttpFoundation\RedirectResponse('/swagger-ui/index.html');
});

// Rotas para o controlador de Pessoa
$app->get('/api/person', 'Controllers\PersonController::getAllPerson');
$app->post('/api/person', 'Controllers\PersonController::createPerson');

// Rotas para o controlador de Contato
$app->get('/api/contact', 'Controllers\ContactController::getAllContacts');
$app->get('/api/contact/{id}', 'Controllers\ContactController::getContactById');
$app->post('/api/contact', 'Controllers\ContactController::createContact');
$app->put('/api/contact/{id}', 'Controllers\ContactController::updateContact');
$app->delete('/api/contact/{id}', 'Controllers\ContactController::deleteContact');


