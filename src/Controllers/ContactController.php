
<?php

use Symfony\Component\HttpFoundation\Request;
use Silex\Application;

/*
    Explicação das Operações

    getAllContacts: Retorna todos os contatos da tabela contato.
    getContactById: Retorna um contato específico com base no ID fornecido.
    createContact: Cria um novo contato com os dados fornecidos no corpo da requisição.
    updateContact: Atualiza um contato existente com base no ID fornecido.
    deleteContact: Remove um contato da tabela com base no ID fornecido.
*/

class ContactController
{
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
        $contact = $app['db']->executeQuery('SELECT * FROM contato WHERE id = ?', [$id])->fetchAssociative();

        if (!$contact) {
            return $app->json(['success' => false, 'message' => 'Contact not found'], 404);
        }

        return $app->json([
            'success' => true,
            'data' => $contact,
            'message' => 'Contact retrieved successfully'
        ], 200);
    }

    // POST: Create a new contact
    public function createContact(Request $request, Application $app)
    {
        $data = json_decode($request->getContent(), true);

        $app['db']->insert('contato', [
            'tipo' => $data['tipo'],
            'descricao' => $data['descricao'] ?? null,
            'valor' => $data['valor'],
            'pessoa_id' => $data['pessoa_id']
        ]);

        return $app->json(['success' => true, 'message' => 'Contact created successfully'], 201);
    }

    // PUT: Update an existing contact
    public function updateContact($id, Request $request, Application $app)
    {
        $data = json_decode($request->getContent(), true);

        $contact = $app['db']->executeQuery('SELECT * FROM contato WHERE id = ?', [$id])->fetchAssociative();

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
        $contact = $app['db']->executeQuery('SELECT * FROM contato WHERE id = ?', [$id])->fetchAssociative();

        if (!$contact) {
            return $app->json(['success' => false, 'message' => 'Contact not found'], 404);
        }

        $app['db']->delete('contato', ['id' => $id]);

        return $app->json(['success' => true, 'message' => 'Contact deleted successfully'], 200);
    }
}
