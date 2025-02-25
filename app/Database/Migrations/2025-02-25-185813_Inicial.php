<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Inicial extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        
        //CRIAR A TABELA DE PEDIDOS
        $this->forge->addField([
            'id' => ['type' => 'INT','auto_increment' => true],
            'idCliente' => ['type' => 'INT'],
            'idProduto' => ['type' => 'INT'],
            'quantidade' => ['type' => 'INT'],
            'data_pedido' => ['type' => 'TIMESTAMP'],
            'status' => ['type' => 'ENUM', 'constraint' => ['Em aberto', 'Pago', 'Cancelado'], 'default' => 'Em aberto'],
        ])
        ->addPrimaryKey('id')
        ->addForeignKey('idCliente', 'clientes', 'id', 'CASCADE', 'CASCADE')
        ->addForeignKey('idProduto', 'produtos', 'id', 'CASCADE', 'CASCADE')
        ->createTable('pedidos2');

        //INSERIR DADOS NA TABELA DE PEDIDOS
        $produtos = [
            [
                'nome'        => 'Notebook Dell',
                'descricao'   => 'Notebook com 16GB RAM e SSD 512GB',
                'preco'       => 4500.00,
                'estoque'     => 10
            ],
            [
                'nome'        => 'Smartphone Samsung',
                'descricao'   => 'Celular com tela AMOLED e câmera de 108MP',
                'preco'       => 3200.00,
                'estoque'     => 15
            ]
        ];

        $db->table('produtos')->insertBatch($produtos);
    }

    public function down()
    {
        $this->forge->dropTable('pedidos2');
    }
}
