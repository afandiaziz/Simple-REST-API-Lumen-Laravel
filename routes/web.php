<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post('/', 'ProductsController@create');
$router->get('/', 'ProductsController@read');
$router->put('/{id}', 'ProductsController@update');
$router->delete('/{id}', 'ProductsController@delete');

$router->post('/register', 'UserController@register');
$router->post('/login', 'UserController@login');
