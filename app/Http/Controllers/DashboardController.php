<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User; // Você não usou, mas pode deixar para o futuro
use App\Models\Filme;

class DashboardController extends Controller
{
    public function index()
    {
        // Consulta 1: Contando quantos filmes existem em cada categoria
        $filmesPorCategoria = DB::table('categorias')
            ->join('categoria_filme', 'categorias.id', '=', 'categoria_filme.categoria_id')
            ->select('categorias.nome', DB::raw('COUNT(categoria_filme.filme_id) as total_filmes'))
            ->groupBy('categorias.nome')
            ->orderBy('total_filmes', 'desc')
            ->get();

        // Consulta 2: Top 10 de filmes por avaliação
        $mediaAvaliacaoFilmes = DB::table('filmes')
            ->join('avaliacoes', 'filmes.id', '=', 'avaliacoes.filme_id')
            ->select('filmes.titulo', DB::raw('AVG(avaliacoes.nota) as media_nota'))
            ->groupBy('filmes.id', 'filmes.titulo')
            ->orderBy('media_nota', 'desc')
            ->limit(10)
            ->get();
            
        // Consulta 3: Último filme lançado e mais antigo
        $anoFilmeMaisRecente = Filme::max('ano_lancamento');
        $anoFilmeMaisAntigo = Filme::min('ano_lancamento');

        // Consulta 4: Quantos filmes por ano
        $filmesPorAno = DB::table('filmes')
            ->select('ano_lancamento', DB::raw('COUNT(id) as total_filmes'))
            ->groupBy('ano_lancamento')
            ->orderBy('ano_lancamento', 'desc')
            ->get();

        // CORREÇÃO AQUI: Passando as variáveis corretas para a view
        return view('dashboard', [
            'filmesPorCategoria' => $filmesPorCategoria,
            'mediaAvaliacaoFilmes' => $mediaAvaliacaoFilmes,
            'anoFilmeMaisRecente' => $anoFilmeMaisRecente,
            'anoFilmeMaisAntigo' => $anoFilmeMaisAntigo,
            'filmesPorAno' => $filmesPorAno,
        ]);
    }
}