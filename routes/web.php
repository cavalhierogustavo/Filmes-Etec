<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\usuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
})->name('login')->middleware('guest'); 


Route::post('/logar', [usuarioController::class, 'login'])->name('login.do');


Route::get('cadastros', function () {
    return view('cadastro');
})->middleware('guest');

Route::post('cadastros', [usuarioController::class, 'store'])->name('cadastro.store');

Route::get('contato', function () {
    return view('contato');
});


Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rotas de cadastro
    Route::get('/admin/filmes/cadastrar', [FilmeController::class, 'create'])->name('filmes.create');
    Route::post('/admin/filmes', [FilmeController::class, 'store'])->name('filmes.store');

    // Rota para a lista de filmes
    Route::get('/admin/filmes/index', [FilmeController::class, 'index'])->name('filmes.index');

    // Rota para a página de edição
    Route::get('/admin/filmes/{filme}/editar', [FilmeController::class, 'edit'])->name('filmes.edit');

    // --- INÍCIO DAS ROTAS FALTANTES ---

    // 3. Rota para ATUALIZAR os dados do filme no banco de dados
    //    Esta é a rota que o formulário de edição precisa!
    Route::put('/admin/filmes/{filme}', [FilmeController::class, 'update'])->name('filmes.update');

    // 4. Rota para DELETAR um filme
    //    Esta rota será necessária para o botão "Deletar".
    Route::delete('/admin/filmes/{filme}', [FilmeController::class, 'destroy'])->name('filmes.destroy');
});

Route::post('/logout', function (Request $request) { // A mágica acontece aqui!
    Auth::logout();

    // Agora estamos usando o objeto $request, e não a Facade Request::
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');

Route::get('/', [HomeController::class, 'index']);