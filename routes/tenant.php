<?php

declare(strict_types=1);

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SetorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EntregadorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CupomController;
use App\Http\Controllers\SubcategoriaController;
use App\Models\Setores;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });
});

Route::middleware([
    'api',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->prefix('api')->group(function () {

    Route::prefix("produtos")->group(function () {
        Route::get('/', [ProdutoController::class, 'index']);
        Route::post('/', [ProdutoController::class, 'store']);
    });

    // Setores
    Route::prefix("setores")->group(function () {
        Route::get('/', [SetorController::class, 'index']);
        Route::post('/', [SetorController::class, 'store']);
        Route::delete('/{id}', [SetorController::class, 'destroy']);
        Route::get('/{id}', [SetorController::class, 'show']);
        Route::put('/{id}', [SetorController::class, 'update']);
    });

    // Categorias
    Route::prefix("categorias")->group(function () {
        Route::get('/', [CategoriaController::class, 'index']);
        Route::post('/', [CategoriaController::class, 'store']);
        Route::delete('/{id}', [CategoriaController::class, 'destroy']);
        Route::get('/{id}', [CategoriaController::class, 'show']);
        Route::put('/{id}', [CategoriaController::class, 'update']);
    });

    // Subcategorias
    Route::prefix("subcategorias")->group(function () {
        Route::get('/', [SubcategoriaController::class, 'index']);
        // Route::post('/', [CategoriaController::class, 'store']);
        // Route::delete('/{id}', [CategoriaController::class, 'destroy']);
        // Route::get('/{id}', [CategoriaController::class, 'show']);
        // Route::put('/{id}', [CategoriaController::class, 'update']);
    });

    // Entregadores
    Route::prefix("entregadores")->group(function () {
        Route::get('/', [EntregadorController::class, 'index']);
        Route::post('/', [EntregadorController::class, 'store']);
        Route::delete('/{id}', [EntregadorController::class, 'destroy']);
        Route::get('/{id}', [EntregadorController::class, 'show']);
        Route::put('/{id}', [EntregadorController::class, 'update']);
    });

    // Clientes
    Route::prefix("clientes")->group(function () {
        Route::get('/', [ClienteController::class, 'index']);
        Route::post('/', [ClienteController::class, 'store']);
        Route::delete('/{id}', [ClienteController::class, 'destroy']);
        Route::get('/{id}', [ClienteController::class, 'show']);
        Route::put('/{id}', [ClienteController::class, 'update']);
    });

    // Cupons
    Route::prefix("cupons")->group(function () {
        Route::get('/', [CupomController::class, 'index']);
        Route::get('/{cupom}', [CupomController::class, 'show']);
        Route::post('/', [CupomController::class, 'store']);
        // Route::delete('/{id}', [ClienteController::class, 'destroy']);
        // Route::get('/{id}', [ClienteController::class, 'show']);
        // Route::put('/{id}', [ClienteController::class, 'update']);
    });
});
