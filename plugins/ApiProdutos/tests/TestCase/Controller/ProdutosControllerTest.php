<?php
declare(strict_types=1);

namespace ApiProdutos\Test\TestCase\Controller;

use ApiProdutos\Controller\ProdutosController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * ApiProdutos\Controller\ProdutosController Test Case
 *
 * @uses \ApiProdutos\Controller\ProdutosController
 */
class ProdutosControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.ApiProdutos.Produtos',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex(): void
    {
        $this->get('produtos');

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(200);
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView(): void
    {
        $this->get('produtos/1');

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(200);
    }

    public function testViewNotFound(): void
    {
        $this->get('produtos/200');

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(404);
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd(): void
    {
        $data = [
            "nome" => "Produto 1",
            "cor" => "Amarelo",
            "tamanho" => "2",
            "valor" => 1.5
        ];
        
        $this->post('produtos', $data);
        $this->assertResponseSuccess();
        $this->assertResponseNotEmpty();
        $this->assertResponseCode(200);
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit(): void
    {
        $data = [
            "nome" => "Produto 2",
            "cor" => "Vermelho",
            "tamanho" => "3",
            "valor" => 2.5
        ];
        
        $this->put('produtos/1', $data);
        $this->assertResponseSuccess();
        $this->assertResponseNotEmpty();
        $this->assertResponseCode(200);
    }

    public function testEditNotFound(): void
    {
        $data = [
            "nome" => "Produto 2",
            "cor" => "Vermelho",
            "tamanho" => "3",
            "valor" => 2.5
        ];
        
        $this->put('produtos/555', $data);

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(404);
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete(): void
    {
        $this->delete('produtos/1');

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(200);
    }

    public function testDeleteNotFound(): void
    {
        $this->delete('produtos/555');

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(404);
    }
}
