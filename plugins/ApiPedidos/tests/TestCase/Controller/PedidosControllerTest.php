<?php
declare(strict_types=1);

namespace ApiClientes\Test\TestCase\Controller;

use ApiClientes\Controller\ClientesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * ApiClientes\Controller\ClientesController Test Case
 *
 * @uses \ApiClientes\Controller\ClientesController
 */
class ClientesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.ApiPedidos.Pedidos',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex(): void
    {
        $this->get('pedidos');

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
        $this->get('pedidos/1');

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(200);
    }

    public function testViewNotFound(): void
    {
        $this->get('pedidos/200');

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
            "data_pedido" => "2021-05-25 02:38:30",
            "observacao" => "Pedido em Analise",
            "forma_pagamento" => "cartao",
            "codigo_cliente" => 1,
            "produtos" => [
                [
                    "codigo" => 3,
                    "nome" => "Produto 1",
                    "quantidade" =>  3,
                    "valor" =>  1.5
                ],
                [
                    "codigo" => 4,
                    "nome" => "Produto 2",
                    "quantidade" =>  3,
                    "valor" =>  5
                ]
            ]
        ];
        
        $this->post('pedidos', $data);
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
            "data_pedido" => "2021-05-25 02:38:30",
            "observacao" => "Pedido em Analise",
            "forma_pagamento" => "cartao",
            "codigo_cliente" => 1,
            "produtos" => [
                [
                    "codigo" => 3,
                    "nome" => "Produto 1",
                    "quantidade" =>  3,
                    "valor" =>  1.5
                ],
                [
                    "codigo" => 4,
                    "nome" => "Produto 2",
                    "quantidade" =>  3,
                    "valor" =>  5
                ]
            ]
        ];
        
        $this->put('pedidos/1', $data);
        $this->assertResponseSuccess();
        $this->assertResponseNotEmpty();
        $this->assertResponseCode(200);
    }

    public function testEditNotFound(): void
    {
        $data = [
            "data_pedido" => "2021-05-25 02:38:30",
            "observacao" => "Pedido em Analise",
            "forma_pagamento" => "cartao",
            "codigo_cliente" => 1,
            "produtos" => [
                [
                    "codigo" => 3,
                    "nome" => "Produto 1",
                    "quantidade" =>  3,
                    "valor" =>  1.5
                ],
                [
                    "codigo" => 4,
                    "nome" => "Produto 2",
                    "quantidade" =>  3,
                    "valor" =>  5
                ]
            ]
        ];
        
        $this->put('pedidos/555', $data);

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
        $this->delete('pedidos/1');

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(200);
    }

    public function testDeleteSemCliente(): void
    {
        $this->delete('pedidos/555');

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(404);
    }
}
