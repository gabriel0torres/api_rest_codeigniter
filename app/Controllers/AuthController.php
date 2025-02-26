<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
    protected $format = 'json';

    public function login()
    {
        $model = new User();
        $data = $this->request->getJSON(true);

        // Verificar se usuário existe
        $user = $model->where('email', $data['email'])->first();

        if (!$user || !password_verify($data['senha'], $user['senha'])) {
            return $this->failUnauthorized('Credenciais inválidas.');
        }

        // Gerar o Token JWT
        $token = generate_jwt($user['id'], $user['email']);

        return $this->respond([
            'status' => 200,
            'mensagem' => 'Login bem-sucedido!',
            'token' => $token
        ]);
    }
}
