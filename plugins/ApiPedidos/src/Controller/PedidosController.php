<?php
declare(strict_types=1);

namespace ApiPedidos\Controller;

use ApiPedidos\Controller\AppController;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Exception\InternalErrorException;
use Cake\Http\Exception;

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
}
