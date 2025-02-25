<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
//$routes->get('/', 'clientes');
//$routes->resource('cliente');

$routes->post('auth/login', 'AuthController::login');
$routes->group('', ['filter' => 'auth'], function ($routes) {
    //$routes->get('produtos', 'ProdutoController::index');
    $routes->resource('cliente');
});


