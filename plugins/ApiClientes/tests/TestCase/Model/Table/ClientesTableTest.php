<?php
declare(strict_types=1);

namespace ApiClientes\Test\TestCase\Model\Table;

use ApiClientes\Model\Table\ClientesTable;
use Cake\TestSuite\TestCase;

/**
 * ApiClientes\Model\Table\ClientesTable Test Case
 */
class ClientesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \ApiClientes\Model\Table\ClientesTable
     */
    protected $Clientes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.ApiClientes.Clientes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Clientes') ? [] : ['className' => ClientesTable::class];
        $this->Clientes = $this->getTableLocator()->get('Clientes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Clientes);

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
