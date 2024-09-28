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


//rotas para das farmacias (e responsaveis)

$router->group(['prefix' => 'farmacia'], function () use ($router) {

    $router->post('/', 'FarmaciaController@store');
    $router->get('/', 'FarmaciaController@index');
    $router->get('/{id}', 'FarmaciaController@show');
    $router->put('/{id}', 'FarmaciaController@update');
    $router->delete('/{id}', 'FarmaciaController@destroy');

});


