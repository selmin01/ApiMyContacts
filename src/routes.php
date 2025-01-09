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
$app->get('/', function () {
    return new JsonResponse(['status' => 'API is running'], 200);
});

// $app->get('/docs', function () {
//     return new Symfony\Component\HttpFoundation\RedirectResponse('/swagger-ui/index.html');
// });
// $app->get('/docs', function () {
//     return new Symfony\Component\HttpFoundation\RedirectResponse('/swagger-ui/index.html', 302);
// });

$app->get('/docs', function () use ($app) {
    return $app->redirect('/swagger-ui/index.html');
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
$app->get('/api/contact/all/{personId}', 'Controllers\ContactController::getContactsByPersonId');
$app->post('/api/contact', 'Controllers\ContactController::createContact');
$app->put('/api/contact/{id}', 'Controllers\ContactController::updateContact');
$app->delete('/api/contact/{id}', 'Controllers\ContactController::deleteContact');


