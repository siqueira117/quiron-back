<?php

declare(strict_types=1);

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SetorController;
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

});
