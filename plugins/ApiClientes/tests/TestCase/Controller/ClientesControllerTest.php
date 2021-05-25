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
        'plugin.ApiClientes.Clientes',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex(): void
    {
        $this->get('clientes');

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
        $this->get('clientes/1');

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(200);
    }

    public function testViewNotFound(): void
    {
        $this->get('clientes/200');

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
            "nome" => "André Santos",
            "cpf" => "114.884.286-11",
            "sexo" => "Masculino",
            "email" => "aluiz536@gmail.com"
        ];
        
        $this->post('clientes', $data);
        $this->assertResponseSuccess();
        $this->assertResponseNotEmpty();
        $this->assertResponseCode(200);
    }

    public function testAddCpfIncorreto(): void
    {
        $data = [
            "nome" => "André Santos",
            "cpf" => "114.884.286-00",
            "sexo" => "Masculino",
            "email" => "aluiz536@gmail.com"
        ];
        
        $this->post('clientes', $data);

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(400);
    }

    public function testAddEmailIncorreto(): void
    {
        $data = [
            "nome" => "André Santos",
            "cpf" => "114.884.286-11",
            "sexo" => "Masculino",
            "email" => "aluiz536@@gmail.com"
        ];
        
        $this->post('clientes', $data);

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(400);
    }

    public function testAddCpfEmailIncorreto(): void
    {
        $data = [
            "nome" => "André Santos",
            "cpf" => "114.884.286-00",
            "sexo" => "Masculino",
            "email" => "aluiz536@@gmail.com"
        ];
        
        $this->post('clientes', $data);

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(400);
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit(): void
    {
        $data = [
            "nome" => "André Santos",
            "cpf" => "114.884.286-11",
            "sexo" => "Masculino",
            "email" => "aluiz536@gmail.com"
        ];
        
        $this->put('clientes/1', $data);
        $this->assertResponseSuccess();
        $this->assertResponseNotEmpty();
        $this->assertResponseCode(200);
    }

    public function testEditSemCliente(): void
    {
        $data = [
            "nome" => "André Santos",
            "cpf" => "114.884.286-11",
            "sexo" => "Masculino",
            "email" => "aluiz536@gmail.com"
        ];
        
        $this->put('clientes/555', $data);

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(404);
    }

    public function testEditCpfIncorreto(): void
    {
        $data = [
            "nome" => "André Santos",
            "cpf" => "114.884.286-00",
            "sexo" => "Masculino",
            "email" => "aluiz536@gmail.com"
        ];
        
        $this->put('clientes/1', $data);

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(400);
    }

    public function testEditEmailIncorreto(): void
    {
        $data = [
            "nome" => "André Santos",
            "cpf" => "114.884.286-11",
            "sexo" => "Masculino",
            "email" => "aluiz536@@gmail.com"
        ];
        
        $this->put('clientes/1', $data);

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(400);
    }

    public function testEditCpfEmailIncorreto(): void
    {
        $data = [
            "nome" => "André Santos",
            "cpf" => "114.884.286-00",
            "sexo" => "Masculino",
            "email" => "aluiz536@@gmail.com"
        ];
        
        $this->put('clientes/1', $data);

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(400);
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete(): void
    {
        $this->delete('clientes/1');

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(200);
    }

    public function testDeleteSemCliente(): void
    {
        $this->delete('clientes/555');

        $this->assertResponseNotEmpty();
        $this->assertResponseCode(404);
    }
}
