<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\usuarioController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('quemsomos', function () {
    return view('quemsomos');
});

Route::get('login', function () {
    return view('login');
});

Route::get('cadastros', function () {
    return view('cadastro');
});

Route::get('contato', function () {
    return view('contato');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/admin/filmes/cadastrar', [FilmeController::class, 'create'])->name('filmes.create');

// Rota para SALVAR o novo filme enviado pelo formulário
Route::post('/admin/filmes', [FilmeController::class, 'store'])->name('filmes.store');


Route::get('/', [HomeController::class, 'index']);