<?php
declare(strict_types=1);

namespace ApiPedidos\Controller;

use ApiPedidos\Controller\AppController;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Exception\InternalErrorException;
use Cake\Http\Exception;
use Cake\Mailer\Mailer;
use Cake\Core\Configure;
use dompdf\Dompdf;

/**
 * Pedidos Controller
 *
 * @method \ApiPedidos\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PedidosController extends AppController
{
    public function initialize():void
    {
        $this->loadModel('ApiPedidos.Pedidos');
        $this->loadComponent('Comum');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        try {
            $pedidos = $this->Pedidos->find();

            $data = [
                'status' => 200,
                'data' => $pedidos,
                'message' => null
            ];
            return $this->response
                        ->withStatus(200)
                        ->withType('application/json')
                        ->withStringBody(json_encode($data));
        // @codeCoverageIgnoreStart               
        }catch(InternalErrorException $e){//500
            $dados = [
                'status' => 500,
                "data" => null,
                "message" => json_decode($e->getMessage(), true)
            ];
            return $this->response
                        ->withStatus(500)
                        ->withType('application/json')
                        ->withStringBody(json_encode($dados)); 
        }
        // @codeCoverageIgnoreEnd
    }

    /**
     * View method
     *
     * @param string|null $id Pedido id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        try {
            $dado_view = $this->Pedidos->findByCodigo($id)->first();

            if (!$dado_view) {
                $dados = ['pedido'=> ['_error' => 'Pedido não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }

            $data = [
                'status' => 200,
                'data' => [$dado_view],
                'message' => null
            ];
            return $this->response
                        ->withStatus(200)
                        ->withType('application/json')
                        ->withStringBody(json_encode($data)); 
        } catch(NotFoundException $e){//404
            $dados = [
                'status' => 404,
                "data" => null,
                "message" => json_decode($e->getMessage(), true)
            ];
            return $this->response
                        ->withStatus(404)
                        ->withType('application/json')
                        ->withStringBody(json_encode($dados)); 
        }catch(InternalErrorException $e){//500
            $dados = [
                'status' => 500,
                "data" => null,
                "message" => json_decode($e->getMessage(), true)
            ];
            return $this->response
                        ->withStatus(500)
                        ->withType('application/json')
                        ->withStringBody(json_encode($dados)); 
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        try {
            $data = $this->request->getData();

            $data['produtos'] = json_encode($data['produtos']);

            $new_entities = $this->Pedidos->newEntity($data);
            $dados_save = $this->Pedidos->patchEntity($new_entities, $data);

            if ($this->Pedidos->save($dados_save)) {
                $data_save = $dados_save;
                $message = "Pedido adicionado com sucesso!";
            } else {
                $dados = ['Erro'=> ['_error' => $dados_save->getErrors()]];
                throw new InternalErrorException(json_encode($dados));
            }

            $data = [
                'status' => 200,
                'data' => [$data_save],
                'message' => $message
            ];
            return $this->response
                        ->withStatus(200)
                        ->withType('application/json')
                        ->withStringBody(json_encode($data)); 
        }catch(BadRequestException $e){//400
            $dados = [
                'status' => 400,
                "data" => null,
                "message" => json_decode($e->getMessage(), true)
            ];
            return $this->response
                        ->withStatus(400)
                        ->withType('application/json')
                        ->withStringBody(json_encode($dados)); 
            //@codeCoverageIgnoreStart
        }catch(InternalErrorException $e){//500
            $dados = [
                'status' => 500,
                "data" => null,
                "message" => json_decode($e->getMessage(), true)
            ];
            return $this->response
                        ->withStatus(500)
                        ->withType('application/json')
                        ->withStringBody(json_encode($dados)); 
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Pedido id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        try {
            $data = $this->request->getData();

            $data['produtos'] = json_encode($data['produtos']);

            $dados_edit = $this->Pedidos->findByCodigo($id)->first();
            if (!$dados_edit) {
                $dados = ['pedido'=> ['_error' => 'Pedido não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }

            $dados_save = $this->Pedidos->patchEntity($dados_edit, $data);

            if ($this->Pedidos->save($dados_save)) {
                $data_save = $dados_save;
                $message = "Pedido alterado com sucesso!";
            } else {
                $dados = ['Erro'=> ['_error' => $dados_save->getErrors()]];
                throw new InternalErrorException(json_encode($dados));
            }

            $data = [
                'status' => 200,
                'data' => [$data_save],
                'message' => $message
            ];
            return $this->response
                        ->withStatus(200)
                        ->withType('application/json')
                        ->withStringBody(json_encode($data)); 
        } catch(NotFoundException $e){//404
            $dados = [
                'status' => 404,
                "data" => null,
                "message" => json_decode($e->getMessage(), true)
            ];
            return $this->response
                        ->withStatus(404)
                        ->withType('application/json')
                        ->withStringBody(json_encode($dados)); 
        }catch(BadRequestException $e){//400
            $dados = [
                'status' => 400,
                "data" => null,
                "message" => json_decode($e->getMessage(), true)
            ];
            return $this->response
                        ->withStatus(400)
                        ->withType('application/json')
                        ->withStringBody(json_encode($dados)); 
            //@codeCoverageIgnoreStart
        }catch(InternalErrorException $e){//500
            $dados = [
                'status' => 500,
                "data" => null,
                "message" => json_decode($e->getMessage(), true)
            ];
            return $this->response
                        ->withStatus(500)
                        ->withType('application/json')
                        ->withStringBody(json_encode($dados)); 
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Pedido id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        try {

            $dados_delete = $this->Pedidos->findByCodigo($id)->first();
            if (!$dados_delete) {
                $dados = ['pedido'=> ['_error' => 'Pedido não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }

            if ($this->Pedidos->delete($dados_delete)) {
                $message = "Pedido excluido com sucesso!";
            } else {
                $dados = ['Erro'=> ['_error' => $dados_save->getErrors()]];
                throw new InternalErrorException(json_encode($dados));
            }

            $data = [
                'status' => 200,
                'data' => [],
                'message' => $message
            ];
            return $this->response
                        ->withStatus(200)
                        ->withType('application/json')
                        ->withStringBody(json_encode($data)); 
        } catch(NotFoundException $e){//404
            $dados = [
                'status' => 404,
                "data" => null,
                "message" => json_decode($e->getMessage(), true)
            ];
            return $this->response
                        ->withStatus(404)
                        ->withType('application/json')
                        ->withStringBody(json_encode($dados)); 
        }catch(InternalErrorException $e){//500
            $dados = [
                'status' => 500,
                "data" => null,
                "message" => json_decode($e->getMessage(), true)
            ];
            return $this->response
                        ->withStatus(500)
                        ->withType('application/json')
                        ->withStringBody(json_encode($dados)); 
        }
    }

    public function envioEmail($id = null)
    {
        try {
            $pedido = $this->Pedidos->findByCodigo($id)
                           ->contain(['Clientes'])
                           ->first();

            if (!$pedido) {
                $dados = ['pedido'=> ['_error' => 'Pedido não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }
            
            $produtos = json_decode($pedido->produtos);

            $corpo_email = "<!DOCTYPE html>".
                            "<html lang='en'>".
                            "<head>".
                                "<meta charset='UTF-8'>".
                                "<meta http-equiv='X-UA-Compatible' content='IE=edge'>".
                                "<meta name='viewport' content='width=device-width, initial-scale=1.0'>".
                                "<style>
                                    table {
                                    font-family: arial, sans-serif;
                                    border-collapse: collapse;
                                    width: 100%;
                                    }
                                    
                                    td, th {
                                    border: 1px solid #dddddd;
                                    text-align: left;
                                    padding: 8px;
                                    }
                                    
                                    tr:nth-child(even) {
                                    background-color: #dddddd;
                                    }
                                </style>".
                            "</head>".
                            "<body>".
                                "<span><b>Nome : </b> {$pedido->cliente->nome}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
                                "<span><b>CPF : </b> {$pedido->cliente->cpf}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
                                "<span><b>Sexo : </b> {$pedido->cliente->sexo}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
                                "<span><b>Email : </b> {$pedido->cliente->email}</span><br><br>".
                                "<hr>".
                                "<span><b>Numero do Pedido : </b> {$pedido->codigo}</span><br>".
                                "<span><b>Forma de Pagamento : </b> {$pedido->forma_pagamento}</span><br>".
                                "<span><b>Data do Pedido : </b> ".date("d-m-Y H:i:s", strtotime((string) $pedido->data_pedido))."</span><br>".
                                "<span><b>Observação : </b> {$pedido->observacao}</span><br><br>".
                                "<table >
                                    <tr>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Valor Unitario</th>
                                        <th>Valor</th>
                                    </tr>";
                                    $valor_total = 0;
                                    foreach ($produtos as $key => $produto) {
                                        $valor = $produto->quantidade * $produto->valor;
                                        $corpo_email .= "<tr>
                                                            <td>{$produto->nome}</td>
                                                            <td>{$produto->quantidade}</td>
                                                            <td>R$ ".number_format($produto->valor, 2, ',', ' ')."</td>
                                                            <td>R$ ".number_format($valor, 2, ',', ' ')."</td>
                                                        </tr>";
                                        $valor_total = $valor_total + $valor;
                                    }
                                    
                                    $corpo_email .= "<tfoot>
                                        <th colspan='3'>Total</th>
                                        <th>R$ ".number_format($valor_total, 2, ',', ' ')."</th>
                                    </tfoot>".
                                "</table>".
                            "</body>".
                            "</html>";
            $email = new Mailer('default');
            $envio_email = $email->setFrom(['api.test536@gmail.com' => 'Detalhes do pedido'])
                    ->setEmailFormat('html')
                    ->setTo($pedido->cliente->email)
                    ->setSubject('Detalhes do pedido')
                    ->deliver($corpo_email);
            if ($envio_email) {
                $message = "Email enviado com sucesso!";
            } else {
                $message = "Erro ao enviar o email!";
            }

            $data = [
                'status' => 200,
                'data' => [],
                'message' => $message
            ];
            return $this->response
                        ->withStatus(200)
                        ->withType('application/json')
                        ->withStringBody(json_encode($data)); 
        } catch(NotFoundException $e){//404
            $dados = [
                'status' => 404,
                "data" => null,
                "message" => json_decode($e->getMessage(), true)
            ];
            return $this->response
                        ->withStatus(404)
                        ->withType('application/json')
                        ->withStringBody(json_encode($dados)); 
        }catch(InternalErrorException $e){//500
            $dados = [
                'status' => 500,
                "data" => null,
                "message" => json_decode($e->getMessage(), true)
            ];
            return $this->response
                        ->withStatus(500)
                        ->withType('application/json')
                        ->withStringBody(json_encode($dados)); 
        }
    }

    public function relatorio($id = null)
    {
        try {
            $pedido = $this->Pedidos->findByCodigo($id)
                           ->contain(['Clientes'])
                           ->first();
            if (!$pedido) {
                $dados = ['pedido'=> ['_error' => 'Pedido não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }
            
            $produtos = json_decode($pedido->produtos);

            $corpo_relatorio = "<!DOCTYPE html>".
                            "<html lang='en'>".
                            "<head>".
                                "<meta charset='UTF-8'>".
                                "<meta http-equiv='X-UA-Compatible' content='IE=edge'>".
                                "<meta name='viewport' content='width=device-width, initial-scale=1.0'>".
                                "<style>
                                    table {
                                    font-family: arial, sans-serif;
                                    border-collapse: collapse;
                                    width: 100%;
                                    }
                                    
                                    td, th {
                                    border: 1px solid #dddddd;
                                    text-align: left;
                                    padding: 8px;
                                    }
                                    
                                    tr:nth-child(even) {
                                    background-color: #dddddd;
                                    }
                                </style>".
                            "</head>".
                            "<body>".
                                "<h3>Detalhes do Pedido</h3>".
                                "<span><b>Nome : </b> {$pedido->cliente->nome}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
                                "<span><b>CPF : </b> {$pedido->cliente->cpf}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
                                "<span><b>Sexo : </b> {$pedido->cliente->sexo}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
                                "<span><b>Email : </b> {$pedido->cliente->email}</span><br><br>".
                                "<hr>".
                                "<span><b>Numero do Pedido : </b> {$pedido->codigo}</span><br>".
                                "<span><b>Forma de Pagamento : </b> {$pedido->forma_pagamento}</span><br>".
                                "<span><b>Data do Pedido : </b> ".date("d-m-Y H:i:s", strtotime((string) $pedido->data_pedido))."</span><br>".
                                "<span><b>Observação : </b> {$pedido->observacao}</span><br><br>".
                                "<table >
                                    <tr>
                                        <th style='text-align:center'>Produto</th>
                                        <th style='text-align:center'>Quantidade</th>
                                        <th style='text-align:center'>Valor Unitario</th>
                                        <th style='text-align:center'>Valor</th>
                                    </tr>";
                                    $valor_total = 0;
                                    foreach ($produtos as $key => $produto) {
                                        $valor = $produto->quantidade * $produto->valor;
                                        $corpo_relatorio .= "<tr>
                                                            <td style='text-align:center'>{$produto->nome}</td>
                                                            <td style='text-align:center'>{$produto->quantidade}</td>
                                                            <td style='text-align:center'>R$ ".number_format($produto->valor, 2, ',', ' ')."</td>
                                                            <td style='text-align:center'>R$ ".number_format($valor, 2, ',', ' ')."</td>
                                                        </tr>";
                                        $valor_total = $valor_total + $valor;
                                    }
                                    
                                    $corpo_relatorio .= "<tr>
                                        <th colspan='3'>Total</th>
                                        <th style='text-align:center'>R$ ".number_format($valor_total, 2, ',', ' ')."</th>
                                    </tr>".
                                "</table>".
                            "</body>".
                            "</html>";
 
            if (!$this->Pedidos->checkTest()) {
                $mpdf = new \Mpdf\Mpdf();
                $mpdf->WriteHTML($corpo_relatorio);
                $mpdf->Output(); 
                exit;
            }

            return $this->response
                        ->withStatus(200)
                        ->withType('application/json')
                        ->withStringBody(json_encode([])); 
        } catch(NotFoundException $e){//404
            $dados = [
                'status' => 404,
                "data" => null,
                "message" => json_decode($e->getMessage(), true)
            ];
            return $this->response
                        ->withStatus(404)
                        ->withType('application/json')
                        ->withStringBody(json_encode($dados)); 
        }catch(InternalErrorException $e){//500
            $dados = [
                'status' => 500,
                "data" => null,
                "message" => json_decode($e->getMessage(), true)
            ];
            return $this->response
                        ->withStatus(500)
                        ->withType('application/json')
                        ->withStringBody(json_encode($dados)); 
        }
    }
}
