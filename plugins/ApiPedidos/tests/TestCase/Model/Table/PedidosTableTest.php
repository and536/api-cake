<?php
declare(strict_types=1);

namespace ApiPedidos\Test\TestCase\Model\Table;

use ApiPedidos\Model\Table\PedidosTable;
use Cake\TestSuite\TestCase;

/**
 * ApiPedidos\Model\Table\PedidosTable Test Case
 */
class PedidosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \ApiPedidos\Model\Table\PedidosTable
     */
    protected $Pedidos;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.ApiPedidos.Pedidos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Pedidos') ? [] : ['className' => PedidosTable::class];
        $this->Pedidos = $this->getTableLocator()->get('Pedidos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Pedidos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
