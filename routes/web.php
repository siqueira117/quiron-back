<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\FarmaciaController;

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});


//rotas para inclusao das farmacias (e responsaveis)
$router->get('/farmacia', 'FarmaciaController@index');
$router->get('/farmacia/{id}', 'FarmaciaController@show');
$router->put('/farmacia/{id}', 'FarmaciaController@update');
$router->delete('/farmacia/{id}', 'FarmaciaController@destroy');
$router->post('/farmacia', 'FarmaciaController@store');
