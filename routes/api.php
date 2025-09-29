<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Filme;
use App\Http\Controllers\usuarioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/cadastro', [usuarioController::class, 'store'])->name('cadastro.store');

Route::post('/contatos', [Filme::class, 'store']);


Route::get('/contatos', [Filme::class, 'index']);



Route::get('/logar',[usuarioController::class, 'login']);

