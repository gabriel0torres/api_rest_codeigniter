<?php

namespace App\Models;
use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['login', 'senha'];
}