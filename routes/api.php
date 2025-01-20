<?php

use App\Helpers\Services\GeoLoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FarmaciaController;

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

    $router->post('/', [FarmaciaController::class, 'store']);
    $router->get('/', [FarmaciaController::class, 'index']);
    $router->get('/{id}', [FarmaciaController::class, 'show']);
    $router->put('/{id}', [FarmaciaController::class, 'update']);
    $router->delete('/{id}', [FarmaciaController::class, 'destroy']);

});