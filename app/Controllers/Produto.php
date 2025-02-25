<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models;

class Produto extends ResourceController
{
    protected $modelName = 'App\Models\Produto';
    protected $format    = 'json';

    // LISTAR TODOS OS PRODUTOS (GET)
    public function index()
    {
        //return $this->respond($this->model->findAll());

        $model = new Models\Produto();

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

    public function show($param = null)
    {
        // Se não houver parâmetro, retorne erro
        if (empty($param)) {
            return $this->failNotFound("Nenhum parâmetro foi fornecido.");
        }

        // Tenta buscar pelo ID primeiro
        $produto = $this->model->find($param);

        // Se não encontrar pelo ID, busca por qualquer outro campo
        if (!$produto) {
            $produto = $this->model->like('nome', $param)
                                   ->orLike('descricao', $param)
                                   ->orLike('preco', $param)
                                   ->orLike('estoque', $param)
                                   ->first();
        }

        if (!$produto) {
            return $this->failNotFound("Nenhum produto encontrado com o valor: $param");
        }

        return $this->respond($produto, 200);
    }

    // CRIAR UM NOVO PRODUTO (POST)
    public function create()
    {
        $data = $this->request->getJSON(true); // Recebe JSON como array associativo
        if (!$this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }
        return $this->respondCreated(['message' => 'Produto inserido com sucesso.']);
    }
    

    // ATUALIZAR UM PRODUTO (PUT)
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        if (!$this->model->find($id)) {
            return $this->failNotFound('Produto não encontrado.');
        }
        $this->model->update($id, $data);
        return $this->respond(['message' => 'Produto atualizado com sucesso.']);
    }


    // DELETAR UM PRODUTO (DELETE)
    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Produto não encontrado.');
        }
        $this->model->delete($id);
        return $this->respondDeleted(['message' => 'Produto deletado com sucesso.']);
    }
}
