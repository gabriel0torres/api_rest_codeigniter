<?php

namespace App\Models;
use CodeIgniter\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'cpf_cnpj'];
}