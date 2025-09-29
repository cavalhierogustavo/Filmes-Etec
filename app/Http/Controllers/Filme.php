<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contato;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage; // Essencial para gerenciar arquivos

class Filme extends Controller
{

    public function index()
    {
        $contatos = Contato::all();
        return response()->json($contatos);
    }
    public function login(Request $request)
    {
     $validator = Validator::make($request->all(),[
            'email' => 'require|email',
            'senha' => 'require|string',
     ]);
      $user = User::where('email', $request['email'])->firstOrFail();
      $token = $user->createToken('auth_token')->plainTextToken;
      
      return response()->json([
            'message' => 'Login realizado com sucesso!',
            'user' => $user->name,
            'token' => $token,
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:contatos,email',
            'senha' => 'required|string|min:6',
            'telefone' => 'required|string|max:20',
            'cpf' => 'required|string|max:14|unique:contatos,cpf',
            'tipo' => 'sometimes|in:cliente,admin',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $data = $request->except('foto');
        $data['senha'] = Hash::make($request->senha);
        $data['tipo'] = $request->input('tipo', 'cliente');

        // LÓGICA CORRETA PARA SALVAR A FOTO
        // Esta condição verifica se um arquivo chamado 'foto' foi realmente enviado.

        // Cria o contato com todos os dados, incluindo a URL da foto
        $contato = Contato::create($data);

        $message = $data['tipo'] === 'admin'
            ? 'Contato administrativo cadastrado com sucesso!'
            : 'Cadastro realizado com sucesso!';

        return response()->json([
            'message' => $message,
            'data' => $contato
        ], 201);
    }
}

