<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filme; // Importe o model Filme

class HomeController extends Controller
{
    /**
     * Exibe a página principal com a lista de filmes.
     */
    public function index()
    {
        // Busca os filmes do banco de dados, ordenados pelos mais recentes.
        // O método with('categorias') carrega as categorias junto para evitar múltiplas consultas.
        $filmes = Filme::with('categorias')->latest()->get();

        // Envia a variável $filmes para a view 'welcome'
        return view('welcome', [
            'filmes' => $filmes
        ]);
    }
}