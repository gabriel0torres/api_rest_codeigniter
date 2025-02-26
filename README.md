# API Rest para cadastro de de pedidos de compra

## O que a API faz?

Esta API foi desenvolvida para realizar o cadastro de pedidos de compra, nela você pode
realizar o CRUD de seus clientes, produtos e pedidos de compra.

## Requisitos para a utilização da API

Para utilizar esta API é necessário que voce tenha instalado em sua máquina:
1. PHP
2. MySQL
3. Composer
CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

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

1. Autenticação

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

2. Clientes

ENPOINT BASE: ```http://localhost/api_rest_codeigniter/public/cliente```



This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

You can read the [user guide](https://codeigniter.com/user_guide/)
corresponding to the latest version of the framework.

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
