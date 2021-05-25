<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class PedidosMigration extends AbstractMigration
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
        $table = $this->table('pedidos',['id' => false, 'primary_key' => 'codigo']);
        $table->addColumn('codigo', 'biginteger', [
            'autoIncrement' => true,
            'identity' => true,
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('codigo_cliente', 'biginteger', [
            'default' => null,
            'null' => false
        ]);
        $table->addColumn('produtos', 'text', [
            'default' => null,
            'null' => false
        ]);
        $table->addColumn('data_pedido', 'timestamp', [
            'default' => null,
            'null' => false
        ]);
        $table->addColumn('observacao', 'string', [
            'default' => null,
            'limit' => 1000,
            'null' => false
        ]);
        $table->addColumn('forma_pagamento', 'string', [
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
        $table->addForeignKey('codigo_cliente', 'clientes', ['codigo'],['constraint'=>'codigo_cliente_foreign']);
        $table->create();
    }
}
