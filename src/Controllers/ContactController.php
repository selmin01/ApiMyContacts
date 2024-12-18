<?php

namespace Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ContactController
{
    /*
        Explicação das Operações

        getAllContacts: Retorna todos os contatos da tabela contato.
        getContactById: Retorna um contato específico com base no ID fornecido.
        createContact: Cria um novo contato com os dados fornecidos no corpo da requisição.
        updateContact: Atualiza um contato existente com base no ID fornecido.
        deleteContact: Remove um contato da tabela com base no ID fornecido.
    */

    // GET: Retrieve all contacts
    public function getAllContacts(Application $app)
    {
        $contacts = $app['db']->executeQuery('SELECT * FROM contato')->fetchAllAssociative();

        return $app->json([
            'success' => true,
            'data' => $contacts,
            'message' => 'Contacts retrieved successfully'
        ], 200);
    }

    // GET: Retrieve a contact by ID
    public function getContactById($id, Application $app)
    {
        $contact = $app['db']->executeQuery('SELECT * FROM contact WHERE id = ?', [$id])->fetchAssociative();

        if (!$contact) {
            return $app->json(['success' => false, 'message' => 'Contact not found'], 404);
        }

        return $app->json([
            'success' => true,
            'data' => $contact,
            'message' => 'Contact retrieved successfully'
        ], 200);
    }

    public function getContactsByPersonId($personId, Application $app)
    {
        // Valida se o person_id é numérico
        if (!is_numeric($personId)) {
            return $app->json(['success' => false, 'message' => 'Invalid person ID'], 400);
        }

        try {
            // Busca todos os contatos associados ao person_id
            $contacts = $app['db']->executeQuery('SELECT * FROM contact WHERE person_id = ?', [$personId])->fetchAllAssociative();
            if (empty($contacts)) {
                return $app->json(['success' => false, 'message' => 'No contacts found for the given person ID'], 404);
            }
            // Retorna os contatos
            return $app->json([
                'success' => true,
                'data' => $contacts,
                'message' => 'Contacts retrieved successfully'
            ], 200);
        } catch (\Exception $e) {
            // Loga o erro
            $app['logger']->error('Erro ao buscar contatos por person_id: ' . $e->getMessage());
            // Retorna um erro genérico
            return $app->json(['success' => false, 'message' => 'An error occurred while retrieving the contacts'], 500);
        }
    }

    // POST: Create a new contact
    public function createContact(Request $request, Application $app)
    {
        $data = json_decode($request->getContent(), true);

        // Checkpoint: Logando os dados recebidos
        $app['logger']->info('Dados recebidos para criar contato', $data);

        if (empty($data['valor'])) {
            return new JsonResponse(['error' => 'The "valor" field is mandatory.'], 400);
        }
        // Verifica se o nome já existe no banco
        $existingContact = $app['db']->executeQuery('SELECT * FROM contact WHERE value = ?', [$data['valor']])
                                    ->fetchAssociative();
        if ($existingContact) {
            return $app->json(['error' => false, 'message' => 'Este contato já está cadastrado.'], 3003);
        }


        try {
            // Inserir o contato no banco de dados
            $app['db']->insert('contact', [
                'type' => $data['tipo'],
                'description' => $data['descricao'] ?? null, // Sem espaço extra
                'value' => $data['valor'],
                'person_id' => $data['pessoa_id']
            ]);
            // Resposta de sucesso
            return $app->json(['success' => true, 'message' => 'Contact created successfully'], 201);
    
        } catch (\Exception $e) {
            // Logando o erro
            $app['logger']->error('Erro ao criar contato', ['error' => $e->getMessage()]);
            // Resposta de erro
            return $app->json(['success' => false, 'message' => 'Erro ao criar contato'], 500);
        }
    }

    // PUT: Update an existing contact
    public function updateContact($id, Request $request, Application $app)
    {
        $data = json_decode($request->getContent(), true);

        $contact = $app['db']->executeQuery('SELECT * FROM contact WHERE id = ?', [$id])->fetchAssociative();

        if (!$contact) {
            return $app->json(['success' => false, 'message' => 'Contact not found'], 404);
        }

        $app['db']->update('contato', [
            'tipo' => $data['tipo'],
            'descricao' => $data['descricao'] ?? null,
            'valor' => $data['valor'],
            'pessoa_id' => $data['pessoa_id']
        ], ['id' => $id]);

        return $app->json(['success' => true, 'message' => 'Contact updated successfully'], 200);
    }

    // DELETE: Delete a contact
    public function deleteContact($id, Application $app)
    {
        $contact = $app['db']->executeQuery('SELECT * FROM contact WHERE id = ?', [$id])->fetchAssociative();
        if (!$contact) {
            return new JsonResponse(['success' => 'Contact not found'], 404);
        }

        $app['db']->executeQuery('DELETE FROM contact WHERE id = ?', [$id]);
        return new JsonResponse(['message' => 'Contact deleted successfully'], 200);

        return $app->json(['success' => true, 'message' => 'Contact deleted successfully'], 200);
    }
}
