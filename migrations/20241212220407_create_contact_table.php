<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

final class CreateContactTable extends AbstractMigration
{
    public function change(): void
    {
        // Verifica se a tabela já existe para evitar duplicação
        if (!$this->hasTable('contact')) {
            $table = $this->table('contact');

            $table->addColumn('type', 'string', ['limit' => 2, 'null' => false])
                ->addColumn('description', 'string', ['limit' => 100, 'null' => true])
                ->addColumn('value', 'string', ['limit' => 255, 'null' => false])
                ->addColumn('person_id', 'integer', ['null' => false, 'signed' => false]) // Define 'signed' para evitar problemas de comparação
                ->addForeignKey(
                    'person_id',
                    'person',
                    'id',
                    ['delete' => 'CASCADE', 'update' => 'NO_ACTION'] // Define as ações de exclusão e atualização
                )
                ->addTimestamps()
                ->create();
        } else {
            $this->output->writeln('A tabela "contact" já existe.');
        }
    }
}
