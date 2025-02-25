<?php

namespace App\Models;
use CodeIgniter\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'descricao', 'preco', 'estoque'];
}