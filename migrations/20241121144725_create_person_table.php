<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePersonTable extends AbstractMigration
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
        $table = $this->table('person');
        $table->addColumn('name', 'string', ['limit' => 255]) // Nome agora com limite de 255 caracteres
            ->addColumn('type', 'string', ['limit' => 1]) // Adicionado o campo tipo com limite de 1 caractere
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
}
