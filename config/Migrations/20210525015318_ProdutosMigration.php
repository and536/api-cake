<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class ProdutosMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('produtos',['id' => false, 'primary_key' => 'codigo']);
        $table->addColumn('codigo', 'biginteger', [
            'autoIncrement' => true,
            'identity' => true,
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('nome', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        $table->addColumn('cor', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        $table->addColumn('tamanho', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        $table->addColumn('valor', 'double', [
            'default' => null,
            'null' => false
        ]);
        $table->addColumn('created', 'timestamp', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ]);
        $table->addColumn('modified', 'timestamp', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();
    }
}
