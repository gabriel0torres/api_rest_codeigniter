# API Rest para cadastro de pedidos de compra

## O que a API faz?

Esta API foi desenvolvida para realizar o cadastro de pedidos de compra, nela você pode
realizar o CRUD de seus clientes, produtos e pedidos de compra.

## Requisitos para a utilização da API

Para utilizar esta API é necessário que voce tenha instalado em sua máquina:
1. PHP
2. MySQL
3. Composer

## Instalação

1. Caso tenha instalado também o Git em sua máquina, você pode rodar diretamente o comando 

`git clone https://github.com/gabriel0torres/api_rest_codeigniter.git` 

para clonar diretamente o repositório, caso não tenha,
copie os arquivos do diretório e cole em um local de sua preferência.

2. Nesta API é necessário a instalação de uma biblioteca para a validação do token, instale-a com o comando:

`composer require firebase/php-jwt`

3. Crie um arquivo `.env` e dentro dele coloque as seguinte propriedades
contendo seus respectivos valores do seu banco de dados:
(É necessário que o database já esteja previamente criado)

*CI_ENVIRONMENT = development* <br>
*database.default.hostname = localhost* <br>
*database.default.database = teste* <br>
*database.default.username = root* <br>
*database.default.password =* <br>
*database.default.DBDriver = MySQLi* <br>
*database.default.port = 3306* <br>

4. Para a criação das tabelas fundamentais e inserção de seus dados, é disponibilizado um arquivo chamado `data-migration`
no diretório raiz contendo o código para um migration que criaremos a seguir, e executaremos o mesmo para a inserção dos dados,
siga as instruções:

* Crie um migration chamado Inicial utilizando o comando

`php spark make:migration Inicial`

* Apague todo o conteúdo do arquivo migration criado, depois copie e cole todo o conteúdo do `data-migration` no arquivo
migration criado.

* Por último, rode a migration utilizando o comando `php spark migrate` 

- [x] Nossa API já está pronta para uso !

## Como utilizar a API ?

Será disponibilizado via anexo em email, uma collection do Postman onde teremos todos os endpoints da API prontos para uso,
caso não queria utilizar o Postman, seguiremos a seguir com todos os enpoints da API:

### 1. Autenticação

Para utilizar todos os endpoints desta API, é necessário primeiramente fazer a autenticação, utilizando o endpoint:

`localhost/api_rest_codeigniter/public/auth/login`

passando o seguinte conteúdo no body da requisição:

```
{
    "email": "admin@admin.com",
    "senha": "1234"
}
```

o retorno esperado deve ser:

```
{
    "status": 200,
    "mensagem": "Login bem-sucedido!",
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDA1ODU0NzQsImV4cCI6MTc0MDU4OTA3NCwidXNlcl9pZCI6IjEiLCJlbWFpbCI6ImFkbWluQGFkbWluLmNvbSJ9.4Z8VsHobLL9l9q69vYLjT2Djz04PSLditu2lYlI0qv4"
}
```
(O token irá variar a cada requisição feita)

Com o token gerado, ele deverá ser incorporado a cada requisição da API no parâmetro Authorization dentro do header.

(Obs: este token tem duração de 1 hora, após a expiração, deve ser gerado um novo)

### 2. Clientes

ENPOINT BASE: 

```http://localhost/api_rest_codeigniter/public/cliente```

2.1 Listando (GET)

utilizando a seguinte url ```http://localhost/api_rest_codeigniter/public/cliente``` conseguimos listar os nossos clientes, lembrando que a API conta com um sistema
de paginação de permite entregar somente 10 clientes por página, o retorno esperado deve ser:

```
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Dados Retornados com sucesso"
    },
    "retorno": {
        "dados": [
            {
                "id": "1",
                "nome": "João Silva",
                "cpf_cnpj": "123.456.789-00"
            },
        ]
    },
    "pagination": {
        "current_page": 1,
        "per_page": 10,
        "total": 23,
        "last_page": 3,
        "next_page": 2,
        "prev_page": null
    }
}
```

Lembrando que a API também conta com um sistema de busca por parametro, basta passar na url o valor que esteja procurando entre os registro que a API já deve
retornar todos os registro que contenham em algum de seus campos o valor passado, exemplo: ```http://localhost/api_rest_codeigniter/public/cliente/joao```.

o seguinte retorno deve ser esperado:

```
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Dados Retornados com sucesso"
    },
    "retorno": {
        "dados": {
            "id": "1",
            "nome": "João Silva",
            "cpf_cnpj": "123.456.789-00"
        }
    }
}
```

2.2 Incluindo (POST)

utilizando a seguinte url ```localhost/api_rest_codeigniter/public/cliente```, conseguimos incluir um novo registro de cliente passando o seguinte código de exemplo no corpo
da requisição: 

```
{
    "nome": "teste",
    "cpf_cnpj": "12345678900"
}
```

o seguinte retorno deve ser esperado:

```
{
    "status": 201,
    "message": "Cliente inserido com sucesso."
}
```

2.3 Atualizando (PUT)

utilizando a seguinte url ```localhost/api_rest_codeigniter/public/cliente/0``` podemos atualizar um registro, lembrando que o id do cliente deve ser colocado no lugar do 0 para
podermos atualizar de acordo com o id do cliente, devemos passar no corpo da requisição o seguinte código contendo os campos e os valores que devem ser atualizados:

```
{
    "cpf_cnpj": "12345678900"
}
```

o seguinte retorno deve ser esperado:

```
{
    "status": 200,
    "mensagem": "Cliente atualizado com sucesso."
}
```

2.4 Excluindo (DELETE)

utilizando a seguinte url ```localhost/api_rest_codeigniter/public/cliente/0``` podemos excluir um registro, lembrando que o id do cliente deve ser colocado no lugar do 0 para
podermos excluir de acordo com o id do cliente.

o seguinte retorno deve ser esperado:

```
{
    "status": 200,
    "mensagem": "Cliente deletado com sucesso."
}
```

### 2. Produtos

ENPOINT BASE: 

```http://localhost/api_rest_codeigniter/public/produto```

2.1 Listando (GET)

utilizando a seguinte url ```http://localhost/api_rest_codeigniter/public/produto``` conseguimos listar os nossos produtos, lembrando que a API conta com um sistema
de paginação de permite entregar somente 10 produtos por página, o retorno esperado deve ser:

```
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Dados Retornados com sucesso"
    },
    "retorno": {
        "dados": [
            {
                "id": "1",
                "nome": "Notebook Dell",
                "descricao": "Notebook com 16GB RAM e SSD 512GB",
                "preco": "4500.00",
                "estoque": "10"
            },
        ]
    },
    "pagination": {
        "current_page": 1,
        "per_page": 10,
        "total": 23,
        "last_page": 3,
        "next_page": 2,
        "prev_page": null
    }
}
```

Lembrando que a API também conta com um sistema de busca por parametro, basta passar na url o valor que esteja procurando entre os registro que a API já deve
retornar todos os registro que contenham em algum de seus campos o valor passado, exemplo: ```http://localhost/api_rest_codeigniter/public/produto/notebook```.

o seguinte retorno deve ser esperado:

```
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Dados Retornados com sucesso"
    },
    "retorno": {
        "dados": {
            "id": "1",
            "nome": "Notebook Dell",
            "descricao": "Notebook com 16GB RAM e SSD 512GB",
            "preco": "4500.00",
            "estoque": "10"
        }
    }
}
```

2.2 Incluindo (POST)

utilizando a seguinte url ```http://localhost/api_rest_codeigniter/public/produto```, conseguimos incluir um novo registro de produto passando o seguinte código de exemplo
no corpo da requisição: 

```
{
    "nome": "teste",
    "descricao": "coloque a descricao aqui",
    "preco": 2.50,
    "estoque": 3
}
```

o seguinte retorno deve ser esperado:

```
{
    "status": 201,
    "mensagem": "Produto inserido com sucesso."
}
```

2.3 Atualizando (PUT)

utilizando a seguinte url ```http://localhost/api_rest_codeigniter/public/produto/1``` podemos atualizar um registro, lembrando que o id do produto deve ser colocado no lugar do 0 para podermos atualizar de acordo com o id do produto, devemos passar no corpo da requisição o seguinte código contendo os campos e os valores que devem ser atualizados:

```
{
    "nome": "teste 2",
    "descricao": "coloque a descricao aqui",
    "preco": 2.50,
    "estoque": 3
}
```

o seguinte retorno deve ser esperado:

```
{
    "status": 200,
    "mensagem": "Produto atualizado com sucesso."
}
```

2.4 Excluindo (DELETE)

utilizando a seguinte url ```http://localhost/api_rest_codeigniter/public/produto/2``` podemos excluir um registro, lembrando que o id do produto deve ser colocado
no lugar do 0 para podermos excluir de acordo com o id do produto.

o seguinte retorno deve ser esperado:

```
{
    "status": 200,
    "mensagem": "Produto deletado com sucesso."
}
```

### 2. Pedidos

ENPOINT BASE: 

```http://localhost/api_rest_codeigniter/public/pedido```

2.1 Listando (GET)

utilizando a seguinte url ```http://localhost/api_rest_codeigniter/public/pedido``` conseguimos listar os nossos pedidos, lembrando que a API conta com um sistema
de paginação de permite entregar somente 10 pedidos por página, o retorno esperado deve ser:

```
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Dados Retornados com sucesso"
    },
    "retorno": {
        "dados": [
            {
                "id": "1",
                "idCliente": "1",
                "idProduto": "3",
                "quantidade": "2",
                "data_pedido": "2025-02-26 15:32:51",
                "status": "Pago"
            },
        ]
    },
    "pagination": {
        "current_page": 1,
        "per_page": 10,
        "total": 23,
        "last_page": 3,
        "next_page": 2,
        "prev_page": null
    }
}
```

Lembrando que a API também conta com um sistema de busca por parametro, basta passar na url o valor que esteja procurando entre os registro que a API já deve
retornar todos os registro que contenham em algum de seus campos o valor passado, exemplo: ```localhost/api_rest_codeigniter/public/pedido/Pago```.

o seguinte retorno deve ser esperado:

```
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Dados Retornados com sucesso"
    },
    "retorno": {
        "dados": {
            "id": "1",
            "idCliente": "1",
            "idProduto": "3",
            "quantidade": "2",
            "data_pedido": "2025-02-26 15:32:51",
            "status": "Pago"
        }
    }
}
```

2.2 Incluindo (POST)

utilizando a seguinte url ```http://localhost/api_rest_codeigniter/public/pedido```, conseguimos incluir um novo registro de pedido passando o seguinte código de exemplo
no corpo da requisição: 

```
{
    "idCliente": 10,
    "idProduto": 1,
    "quantidade": 1,
    "status": "Em aberto"
}
```

o seguinte retorno deve ser esperado:

```
{
    "status": 201,
    "mensagem": "Pedido inserido com sucesso."
}
```

2.3 Atualizando (PUT)

utilizando a seguinte url ```http://localhost/api_rest_codeigniter/public/pedido/1``` podemos atualizar um registro, lembrando que o id do pedido deve ser colocado no lugar do 0 para podermos atualizar de acordo com o id do pedido, devemos passar no corpo da requisição o seguinte código contendo os campos e os valores que devem ser atualizados:

```
{
    "status": "Pago"
}
```

o seguinte retorno deve ser esperado:

```
{
    "status": 200,
    "mensagem": "Pedido atualizado com sucesso."
}
```

2.4 Excluindo (DELETE)

utilizando a seguinte url ```http://localhost/api_rest_codeigniter/public/pedido/3``` podemos excluir um registro, lembrando que o id do pedido deve ser colocado
no lugar do 0 para podermos excluir de acordo com o id do pedido.

o seguinte retorno deve ser esperado:

```
{
    "status": 200,
    "message": "Pedido deletado com sucesso."
}
```

