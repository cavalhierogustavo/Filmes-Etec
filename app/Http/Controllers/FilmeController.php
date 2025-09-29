<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filme;
use App\Models\Categoria;

class FilmeController extends Controller
{
    /**
     * Mostra o formulário para criar um novo filme.
     */
    public function create()
    {
    $categorias = Categoria::orderBy('nome')->get();

        // 3. Envia a variável $categorias para a view
        return view('create', [
            'categorias' => $categorias
        ]);
        return view('create');
    }

    /**
     * Salva um novo filme no banco de dados.
     */
    public function store(Request $request)
    {
        // 1. Validação dos dados
         $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'ano_lancamento' => 'required|integer|min:1895',
            'diretor' => 'required|string|max:255',
            'sinopse' => 'nullable|string',
            'cartaz' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'categorias' => 'required|array', // Garante que 'categorias' seja enviado e seja um array
            'categorias.*' => 'exists:categorias,id' // Garante que cada ID de categoria enviado exista na tabela 'categorias'
        ]);

        $path = null;
        if ($request->hasFile('cartaz')) {
            $path = $request->file('cartaz')->store('public/cartazes');
        }

        // 2. Cria o filme no banco de dados (usando os dados validados)
        $filme = Filme::create([
            'titulo' => $validated['titulo'],
            'ano_lancamento' => $validated['ano_lancamento'],
            'diretor' => $validated['diretor'],
            'sinopse' => $validated['sinopse'],
            'cartaz_path' => $path
        ]);

        // 3. Associa as categorias ao filme recém-criado
        // O método attach() é usado para salvar relações "Muitos-para-Muitos"
        $filme->categorias()->attach($validated['categorias']);

        // 4. Redireciona de volta com uma mensagem de sucesso
        return redirect()->route('filmes.create')->with('success', 'Filme cadastrado com sucesso!');
    }
}