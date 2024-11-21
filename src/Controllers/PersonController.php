<?php
namespace Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonController
{
    public function getAllPerson(Application $app)
    {
        $people = $app['db']->executeQuery('SELECT * FROM person')->fetchAllAssociative();
        return $app->json($people, 200);
    }

    public function createPerson(Request $request, Application $app)
    {
        print_r($app);
        $data = json_decode($request->getContent(), true);
        $app['db']->insert('person', [
            'name' => $data['name'],
            'type' => $data['type'],
        ]);
        return $app->json(['message' => 'Person created successfully'], 201);
    }
}
