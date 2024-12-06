<?php
namespace Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonController
{

    public function getAllPerson(Application $app)
    {
        $people = $app['db']->executeQuery('SELECT * FROM person')->fetchAllAssociative();

        return $app->json([
            'success' => true,
            'data' => $people,
            'message' => 'People retrieved successfully'
        ], 200);
        // return $app->json($people, 200);
    }

    public function createPerson(Request $request, Application $app)
    {
        $data = json_decode($request->getContent(), true);
        
        // print_r($data);
        // $app['db']->insert('person', [
        //     'name' => $data['name'],
        //     'type' => $data['type'],
        // ]);
        // return $app->json(['message' => 'Person created successfully'], 201);

        if (empty($data['name'])) {
            return new JsonResponse(['error' => 'O campo "name" é obrigatório.'], 400);
        }else{
            $app['db']->insert('person', [
                'name' => $data['name'],
                'type' => $data['type'],
            ]);
        }
    
        return new JsonResponse([
            'message' => 'Person created successfully',
            'data' => $data
        ], 200);
    }

    public function deletePerson($id) {
        global $app; // Acessa o container $app globalmente

        // Verifica se a pessoa existe
        $person = $app['db']->executeQuery('SELECT * FROM person WHERE id = ?', [$id])->fetchAssociative();
        
        if (!$person) {
            return new JsonResponse(['error' => 'Pessoa não encontrada'], 404);
        }

        // Exclui a pessoa
        $app['db']->executeQuery('DELETE FROM person WHERE id = ?', [$id]);

        return new JsonResponse(['message' => 'Pessoa excluída com sucesso'], 200);
    }
}
