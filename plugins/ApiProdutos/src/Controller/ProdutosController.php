<?php
declare(strict_types=1);

namespace ApiProdutos\Controller;

use ApiProdutos\Controller\AppController;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Exception\InternalErrorException;
use Cake\Http\Exception;


/**
 * Produtos Controller
 *
 * @method \ApiProdutos\Model\Entity\Produto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProdutosController extends AppController
{
    public function initialize():void
    {
        $this->loadModel('ApiProdutos.Produtos');
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
            $produtos = $this->Produtos->find();

            $data = [
                'status' => 200,
                'data' => $produtos,
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
     * @param string|null $id Produto id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        try {
            $dado_view = $this->Produtos->findByCodigo($id)->first();

            if (!$dado_view) {
                $dados = ['produto'=> ['_error' => 'Produto não encontrado.']];
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

            $new_entities = $this->Produtos->newEntity($data);
            $dados_save = $this->Produtos->patchEntity($new_entities, $data);

            if ($this->Produtos->save($dados_save)) {
                $data_save = $dados_save;
                $message = "Produto adicionado com sucesso!";
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
     * @param string|null $id Produto id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        try {
            $data = $this->request->getData();

            $dados_edit = $this->Produtos->findByCodigo($id)->first();
            if (!$dados_edit) {
                $dados = ['produto'=> ['_error' => 'Produto não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }

            $dados_save = $this->Produtos->patchEntity($dados_edit, $data);

            if ($this->Produtos->save($dados_save)) {
                $data_save = $dados_save;
                $message = "Produto alterado com sucesso!";
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
     * @param string|null $id Produto id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        try {

            $dados_delete = $this->Produtos->findByCodigo($id)->first();
            if (!$dados_delete) {
                $dados = ['produto'=> ['_error' => 'Produto não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }

            if ($this->Produtos->delete($dados_delete)) {
                $message = "Produto excluido com sucesso!";
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
