<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filme;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage; // IMPORTANTE: Adicionar o import do Storage

class FilmeController extends Controller
{
    /**
     * MÉTODO FALTANTE: Lista todos os filmes para a página de gerenciamento.
     */
    public function index()
    {
        
        $filmes = Filme::where('deleted', 0) // <-- SÓ PEGA FILMES ONDE 'deleted' É 0
                   ->orderBy('created_at', 'desc')
                   ->get();

        // Retorna a view de gerenciamento que criamos (filmes/index.blade.php)
        return view('filmes.index', ['filmes' => $filmes]);
    }

    /**
     * Mostra o formulário para criar um novo filme.
     */
    public function create()
    {
        $categorias = Categoria::orderBy('nome')->get();

        // CORREÇÃO: Removido o return duplicado.
        return view('create', [
            'categorias' => $categorias
        ]);
    }

    /**
     * Salva um novo filme no banco de dados.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'ano_lancamento' => 'required|integer|min:1895',
            'diretor' => 'required|string|max:255',
            'sinopse' => 'nullable|string',
            'cartaz' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'categorias' => 'required|array',
            'categorias.*' => 'exists:categorias,id'
            
        ]);

        // O 'if' aqui é desnecessário, pois o campo é 'required'. Mas não causa erro.
        $path = $request->file('cartaz')->store('public/cartazes');

        $filme = Filme::create([
            'titulo' => $validated['titulo'],
            'ano_lancamento' => $validated['ano_lancamento'],
            'diretor' => $validated['diretor'],
            'sinopse' => $validated['sinopse'],
            'cartaz_path' => $path,
            'deleted' => 0,
        ]);

        $filme->categorias()->attach($validated['categorias']);

        // CORREÇÃO: Redireciona para a PÁGINA DE LISTAGEM (gerenciamento) após o cadastro.
        return redirect()->route('filmes.index')->with('success', 'Filme cadastrado com sucesso!');
    }

    /**
     * Mostra o formulário para editar um filme existente.
     */
    public function edit(Filme $filme)
    {
        $categorias = Categoria::all(); // Pega todas as categorias para o select
        return view('filmes.edit', [
            'filme' => $filme, // Envia o filme que será editado
            'categorias' => $categorias
        ]);
    }

    /**
     * Atualiza um filme no banco de dados.
     */
    public function update(Request $request, Filme $filme)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'ano_lancamento' => 'required|integer|min:1895',
            'diretor' => 'required|string|max:255',
            'sinopse' => 'nullable|string',
            'cartaz' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'categorias' => 'required|array',
            'categorias.*' => 'exists:categorias,id'
        ]);

        if ($request->hasFile('cartaz')) {
            if ($filme->cartaz_path) {
                Storage::delete($filme->cartaz_path);
            }
            $validated['cartaz_path'] = $request->file('cartaz')->store('public/cartazes');
        }

        $filme->update($validated);

        $filme->categorias()->sync($validated['categorias']);

        return redirect()->route('filmes.index')->with('success', 'Filme atualizado com sucesso!');
    }

    /**
     * Remove um filme do banco de dados.
     */
    public function destroy(Filme $filme)
    {
        if ($filme->cartaz_path) {
            Storage::delete($filme->cartaz_path);
        }

        $filme->delete();

        return redirect()->route('filmes.index')->with('success', 'Filme deletado com sucesso!');
    }
}
