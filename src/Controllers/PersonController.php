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

    public function getPersonById($id, Application $app)
    {
        // Busca a pessoa no banco de dados pelo ID
        $person = $app['db']->executeQuery('SELECT * FROM person WHERE id = ?', [$id])->fetchAssociative();

        if (!$person) {
            return new JsonResponse(['error' => 'Pessoa não encontrada'], 404);
        }

        return new JsonResponse([
            'success' => true,
            'data' => $person,
            'message' => 'Pessoa encontrada com sucesso'
        ], 200);
    }

    public function createPerson(Request $request, Application $app)
    {
        $data = json_decode($request->getContent(), true);
        if (empty($data['name'])) {
            return new JsonResponse(['error' => 'The "name" field is mandatory.'], 400);
        }
        // Verifica se o nome já existe no banco
        $existingPerson = $app['db']->executeQuery('SELECT * FROM person WHERE name = ?', [$data['name']])
                                    ->fetchAssociative();

        
        if ($existingPerson) {
            return new JsonResponse(['error' => 'Este nome de contato já está cadastrado.'], 400);
        }
        // Insere o registro se o nome não for duplicado
        $app['db']->insert('person', [
            'name' => $data['name'],
            'type' => $data['type'],
        ]);
        
        return new JsonResponse([
            'message' => 'Person created successfully',
            'data' => $data
        ], 200);
    }

    public function updatePerson($id, Request $request, Application $app)
    {
        // Decodifica o corpo da requisição
        $data = json_decode($request->getContent(), true);

        if (empty($data['name'])) {
            return new JsonResponse(['error' => 'O campo "name" é obrigatório.'], 400);
        }

        // Verifica se a pessoa existe
        $person = $app['db']->executeQuery('SELECT * FROM person WHERE id = ?', [$id])->fetchAssociative();
        if (!$person) {
            return new JsonResponse(['error' => 'Pessoa não encontrada'], 404);
        }

        // Atualiza os dados da pessoa no banco
        $app['db']->update('person', [
            'name' => $data['name'],
            'type' => $data['type'] ?? $person['type'], // Mantém o valor atual se não for fornecido
        ], ['id' => $id]);

        return new JsonResponse([
            'success' => true,
            'message' => 'Person updated successfully',
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

        return new JsonResponse(['message' => 'Pessoa excluída com sucesso.'], 200);
    }
}
