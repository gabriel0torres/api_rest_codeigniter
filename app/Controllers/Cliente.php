<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models;

class Cliente extends ResourceController
{
    protected $modelName = 'App\Models\Cliente';
    protected $format    = 'json';

    // LISTAR TODOS OS CLIENTES (GET)
    public function index()
    {
        //return $this->respond($this->model->findAll());

        $model = new Models\Cliente();

        // Pegando os parâmetros "page" e "limit" da URL (com valores padrão)
        $page  = $this->request->getGet('page') ?? 1;  // Página atual (default: 1)
        $limit = $this->request->getGet('limit') ?? 10; // Itens por página (default: 10)

        // Busca paginada no banco de dados
        $data = $model->paginate($limit, 'default', $page);

        // Retorna a resposta em JSON, incluindo informações da paginação
        return $this->respond([
            'status'  => 200,
            'message' => 'Lista de produtos paginada',
            'data'    => $data,
            'pagination' => [
                'current_page' => $page,
                'per_page'     => $limit,
                'total'        => $model->pager->getTotal(),
                'last_page'    => $model->pager->getPageCount(),
                /*'next_page'    => $model->pager->hasNext() ? $page + 1 : null,
                'prev_page'    => $model->pager->hasPrevious() ? $page - 1 : null*/
                'next_page'    => ($model->pager->getCurrentPage() < $model->pager->getPageCount()) ? $model->pager->getCurrentPage() + 1 : null,
                'prev_page'    => ($model->pager->getCurrentPage() > 1) ? $model->pager->getCurrentPage() - 1 : null
            ]
        ]);
    }

    // OBTER UM CLIENTES ESPECÍFICO (GET)
    public function show($id = null)
    {
        $cliente = $this->model->find($id);
        if (!$cliente) {
            return $this->failNotFound('Cliente não encontrado.');
        }
        return $this->respond($cliente);
    }

    // CRIAR UM NOVO CLIENTE (POST)
    public function create()
    {
        $data = $this->request->getJSON(true); // Recebe JSON como array associativo
        if (!$this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }
        return $this->respondCreated(['message' => 'Cliente inserido com sucesso.']);
    }
    

    // ATUALIZAR UM CLIENTE (PUT)
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        if (!$this->model->find($id)) {
            return $this->failNotFound('Cliente não encontrado.');
        }
        $this->model->update($id, $data);
        return $this->respond(['message' => 'Cliente atualizado com sucesso.']);
    }


    // DELETAR UM CLIENTE (DELETE)
    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Cliente não encontrado.');
        }
        $this->model->delete($id);
        return $this->respondDeleted(['message' => 'Cliente deletado com sucesso.']);
    }
}
