<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models;

class Pedido extends ResourceController
{
    protected $modelName = 'App\Models\Pedido';
    protected $format    = 'json';

    // LISTAR TODOS OS PEDIDO (GET)
    public function index()
    {
        //return $this->respond($this->model->findAll());

        $model = new Models\Pedido();

        // Pegando os parâmetros "page" e "limit" da URL (com valores padrão)
        $page  = $this->request->getGet('page') ?? 1;  // Página atual (default: 1)
        $limit = $this->request->getGet('limit') ?? 10; // Itens por página (default: 10)

        // Busca paginada no banco de dados
        $data = $model->paginate($limit, 'default', $page);

        // Retorna a resposta em JSON, incluindo informações da paginação
        return $this->respond([
            'status'  => 200,
            'message' => 'Lista de pedidos paginada',
            'data'    => $data,
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
        // Se não houver parâmetro, retorne erro
        if (empty($param)) {
            return $this->failNotFound("Nenhum parâmetro foi fornecido.");
        }

        // Tenta buscar pelo ID primeiro
        $pedido = $this->model->find($param);

        // Se não encontrar pelo ID, busca por qualquer outro campo
        if (!$pedido) {
            $pedido = $this->model->like('idCliente', $param)
                                   ->orLike('idProduto', $param)
                                   ->orLike('quantidade', $param)
                                   ->orLike('data_pedido', $param)
                                   ->orLike('status', $param)
                                   ->first();
        }

        if (!$pedido) {
            return $this->failNotFound("Nenhum pedido encontrado com o valor: $param");
        }

        return $this->respond($pedido, 200);
    }

    // CRIAR UM NOVO PEDIDO (POST)
    public function create()
    {
        $data = $this->request->getJSON(true); // Recebe JSON como array associativo
        if (!$this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }
        return $this->respondCreated(['message' => 'Pedido inserido com sucesso.']);
    }
    

    // ATUALIZAR UM PEDIDO (PUT)
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        if (!$this->model->find($id)) {
            return $this->failNotFound('Pedido não encontrado.');
        }
        $this->model->update($id, $data);
        return $this->respond(['message' => 'Pedido atualizado com sucesso.']);
    }


    // DELETAR UM PEDIDO (DELETE)
    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Pedido não encontrado.');
        }
        $this->model->delete($id);
        return $this->respondDeleted(['message' => 'Pedido deletado com sucesso.']);
    }
}
