<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class ClientesMigration extends AbstractMigration
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
        $table = $this->table('clientes',['id' => false, 'primary_key' => 'codigo']);
        $table->addColumn('codigo', 'biginteger', [
            'autoIncrement' => true,
            'identity' => true,
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('cpf', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        $table->addColumn('nome', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        $table->addColumn('sexo', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 255,
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
        $table->addIndex(['cpf'], ['unique' => true]);
        $table->create();
    }
}
