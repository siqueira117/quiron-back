<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//rotas para das farmacias (e responsaveis)
$router->group(['prefix' => 'farmacia'], function () use ($router) {

    $router->post('/', 'FarmaciaController@store');
    $router->get('/', 'FarmaciaController@index');
    $router->get('/{id}', 'FarmaciaController@show');
    $router->put('/{id}', 'FarmaciaController@update');
    $router->delete('/{id}', 'FarmaciaController@destroy');

});
