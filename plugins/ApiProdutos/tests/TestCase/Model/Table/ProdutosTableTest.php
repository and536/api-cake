<?php
declare(strict_types=1);

namespace ApiProdutos\Test\TestCase\Model\Table;

use ApiProdutos\Model\Table\ProdutosTable;
use Cake\TestSuite\TestCase;

/**
 * ApiProdutos\Model\Table\ProdutosTable Test Case
 */
class ProdutosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \ApiProdutos\Model\Table\ProdutosTable
     */
    protected $Produtos;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.ApiProdutos.Produtos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Produtos') ? [] : ['className' => ProdutosTable::class];
        $this->Produtos = $this->getTableLocator()->get('Produtos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Produtos);

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
