<?php

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Rota global para capturar OPTIONS
$app->match("{url}", function (Request $request) {
    if ($request->getMethod() === "OPTIONS") {
        $response = new Response();
        $response->headers->set("Access-Control-Allow-Origin", "*");
        $response->headers->set("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS");
        $response->headers->set("Access-Control-Allow-Headers", "Content-Type, Authorization, X-Requested-With");
        return $response;
    }

    return new Response("Method Not Allowed", 405);
})->assert("url", ".*")->method("OPTIONS");

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
$app->get('/api/person/{id}', 'Controllers\PersonController::getPersonById');
$app->post('/api/person', 'Controllers\PersonController::createPerson');
$app->put('/api/person/{id}', 'Controllers\PersonController::updatePerson');
$app->delete('/api/person/{id}', 'Controllers\PersonController::deletePerson');


// Rotas para o controlador de Contato
$app->get('/api/contact', 'Controllers\ContactController::getAllContacts');
$app->get('/api/contact/{id}', 'Controllers\ContactController::getContactById');
$app->post('/api/contact', 'Controllers\ContactController::createContact');
$app->put('/api/contact/{id}', 'Controllers\ContactController::updateContact');
$app->delete('/api/contact/{id}', 'Controllers\ContactController::deleteContact');


