<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

return function ($app) {
    // Middleware para adicionar cabeçalhos globais às respostas
    $app->after(function (Request $request, Response $response) {
        $response->headers->set('Access-Control-Allow-Origin', '*'); // Permitir qualquer origem
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS'); // Métodos permitidos
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With'); // Cabeçalhos permitidos
    });
};
