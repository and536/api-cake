<?php
declare(strict_types=1);

namespace ApiClientes\Controller;

use ApiClientes\Controller\AppController;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Exception\InternalErrorException;
use Cake\Http\Exception;

/**
 * Clientes Controller
 *
 * @method \ApiClientes\Model\Entity\Cliente[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientesController extends AppController
{


    public function initialize():void
    {
        $this->loadModel('ApiClientes.Clientes');
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
            $clientes = $this->Clientes->find();

            foreach ($clientes as $key => $cliente) {
                $retorna_clientes = $this->corrigeCpf($cliente);
            }

            $data = [
                'status' => 200,
                'data' => $clientes,
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
     * @param string|null $id Cliente id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        try {
            $dado_view = $this->Clientes->findByCodigo($id)->first();

            if (!$dado_view) {
                $dados = ['cliente'=> ['_error' => 'Cliente não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }

            $dado_view->cpf = $this->Comum->formataCPF($dado_view->cpf);

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

            $dados = $this->validaDadosAdd($data);

            $new_entities = $this->Clientes->newEntity($dados);
            $dados_save = $this->Clientes->patchEntity($new_entities, $dados);

            if ($this->Clientes->save($dados_save)) {
                $data_save = $dados_save;
                $message = "Cliente adicionado com sucesso!";
            } else {
                $dados = ['Erro'=> ['_error' => $dados_save->getErrors()]];
                throw new InternalErrorException(json_encode($dados));
            }

            $data_save->cpf = $this->Comum->formataCPF($data_save->cpf);

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
     * @param string|null $id Cliente id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        try {
            $data = $this->request->getData();

            $dados = $this->validaDadosAdd($data);

            $dados_edit = $this->Clientes->findByCodigo($id)->first();
            if (!$dados_edit) {
                $dados = ['cliente'=> ['_error' => 'Cliente não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }

            $dados_save = $this->Clientes->patchEntity($dados_edit, $dados);

            if ($this->Clientes->save($dados_save)) {
                $data_save = $dados_save;
                $message = "Cliente alterado com sucesso!";
            } else {
                $dados = ['Erro'=> ['_error' => $dados_save->getErrors()]];
                throw new InternalErrorException(json_encode($dados));
            }

            $data_save->cpf = $this->Comum->formataCPF($data_save->cpf);

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
     * @param string|null $id Cliente id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        try {

            $dados_delete = $this->Clientes->findByCodigo($id)->first();
            if (!$dados_delete) {
                $dados = ['cliente'=> ['_error' => 'Cliente não encontrado.']];
                throw new NotFoundException(json_encode($dados));
            }

            if ($this->Clientes->delete($dados_delete)) {
                $message = "Cliente excluido com sucesso!";
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

    private function validaDadosAdd($dados)
    {
        $bool = false;
        $dados_erro = [];
        if (!$this->Comum->validaCPF($dados['cpf']))
        {
            $bool = true;
            $dados_cpf = ['cpf'=> ['_error' => 'CPF inválido.']];
            array_push($dados_erro, $dados_cpf);
        }

        if (!$this->Comum->valida_email($dados['email']))
        {
            $bool = true;
            $dados_email = ['email'=> ['_error' => 'Email inválido.']];
            array_push($dados_erro, $dados_email);
        }

        if ($bool) {
            throw new BadRequestException(json_encode($dados_erro));
        }

        $dados['cpf'] = $this->Comum->removeCaractere($dados['cpf']);

        return $dados;
    }

    private function corrigeCpf($data)
    {
        $data->cpf = $this->Comum->formataCPF($data->cpf);

        return $data;
    }
}
