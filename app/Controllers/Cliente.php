<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;

class Cliente extends ResourceController
{
    protected $modelName = 'App\Models\Cliente';
    protected $format    = 'json';

    // LISTAR TODOS OS CLIENTES (GET)
    public function index()
    {
        //return $this->respond($this->model->findAll());

        $model = $this->model;

        // Aqui pegaqmos os valores dos parâmetros de page e limit da url
        $page  = $this->request->getGet('page') ?? 1;  // Página atual (default: 1)
        $limit = $this->request->getGet('limit') ?? 10; // Itens por página (default: 10)

        // Busca paginada no banco de dados
        $data = $model->paginate($limit, 'default', $page);

        // Retorna a resposta em JSON, incluindo informações da paginação
        return $this->respond([
            'cabecalho'=> [
            'status'  => 200,
            'mensagem' => 'Dados Retornados com sucesso',
            ],
            'retorno' => [
                'dados' => $data,
            ],
            'pagination' => [
                'current_page' => $page,
                'per_page'     => $limit,
                'total'        => $model->pager->getTotal(),
                'last_page'    => $model->pager->getPageCount(),
                'next_page'    => ($model->pager->getCurrentPage() < $model->pager->getPageCount()) ? $model->pager->getCurrentPage() + 1 : null,
                'prev_page'    => ($model->pager->getCurrentPage() > 1) ? $model->pager->getCurrentPage() - 1 : null
            ]
            
        ]);
    }

    public function show($param = null)
    {
        // Se não houver parâmetro, retornamos erro
        if (empty($param)) {
            return $this->failNotFound('Nenhum cliente encontrado com estes parâmetros');
        }

        // Primeiro tentamos buscar por id
        $cliente = $this->model->find($param);

        // Se não encontrar pelo ID, buscamos por qualquer outro campo
        if (!$cliente) {
            $cliente = $this->model->like('nome', $param)
                                   ->orLike('cpf_cnpj', $param)
                                   ->first();
        }

        if (!$cliente) {
            return $this->failNotFound("Nenhum cliente encontrado com o valor: $param");
        }

        return $this->respond($cliente, 200);
    }

    // CRIAR UM NOVO CLIENTE (POST)
    public function create()
    {
        $data = $this->request->getJSON(true); // Recebe JSON como array associativo
        if (!$this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }
        return $this->respondCreated([
            'status' => 201,
            'mensagem' => 'Cliente inserido com sucesso.'
        ]);
    }
    

    // ATUALIZAR UM CLIENTE (PUT)
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        if (!$this->model->find($id)) {
            return $this->failNotFound('Cliente não encontrado.');
        }
        $this->model->update($id, $data);
        return $this->respond([
            'status' => 200,
            'mensagem' => 'Cliente atualizado com sucesso.']);
    }


    // DELETAR UM CLIENTE (DELETE)
    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Cliente não encontrado.');
        }
        $this->model->delete($id);
        return $this->respondDeleted([
            'status' => 200,
            'mensagem' => 'Cliente deletado com sucesso.']);
    }
}
