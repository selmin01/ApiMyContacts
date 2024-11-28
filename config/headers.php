<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Middleware para adicionar cabeçalhos globais
return function ($app) {
    $app->after(function (Request $request, Response $response) {
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        // $response->headers->set('Content-Type', 'application/json');
        // $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
        // $response->headers->set('Access-Control-Allow-Private-Network', 'true');
    });
};
