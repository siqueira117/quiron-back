<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Feel free to customize them however you want. Good luck!
| Here you can register the entregador routes for your application.
|
*/

Auth::routes();

Route::get('/index', [App\Http\Controllers\EntregadorController::class, 'index'])->name('index');
Route::post('/store', [App\Http\Controllers\EntregadorController::class, 'store'])->name('store');
Route::get('/show', [App\Http\Controllers\EntregadorController::class, 'show'])->name('show');
Route::put('/update', [App\Http\Controllers\EntregadorController::class, 'update'])->name('update');
Route::delete('/destroy', [App\Http\Controllers\EntregadorController::class, 'destroy'])->name('destroy');
