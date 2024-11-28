<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateContactTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        // Criação da tabela 'contato'
        $table = $this->table('contact');
        $table->addColumn('tipo', 'string', ['limit' => 2, 'null' => false]) // Tipo de contato (Ex.: email, telefone)
                ->addColumn('descricao', 'string', ['limit' => 100, 'null' => true]) // Descrição do contato
                ->addColumn('valor', 'string', ['limit' => 255, 'null' => false]) // Valor do contato (Ex.: número, email)
                ->addColumn('pessoa_id', 'integer', ['null' => false]) // Chave estrangeira para a pessoa
                ->addForeignKey('pessoa_id', 'person', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION']) // Chave estrangeira
                ->addTimestamps() // Cria 'created_at' e 'updated_at'
                ->create();
    }
}
