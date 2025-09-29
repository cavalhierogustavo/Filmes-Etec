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
// Rota para CRIAR um novo contato (POST)
Route::post('/contatos', [Filme::class, 'store']);

// Rota para LER (LISTAR) todos os contatos (GET)
Route::get('/contatos', [Filme::class, 'index']);

Route::get('/contatos',[Filme::class, 'login']);

// Futuramente, você adicionará as outras rotas aqui:
// Route::get('/contatos/{id}', [Filme::class, 'show']); // Para ver um específico
// Route::put('/contatos/{id}', [Filme::class, 'update']); // Para atualizar
// Route::delete('/contatos/{id}', [Filme::class, 'destroy']); // Para deletar
