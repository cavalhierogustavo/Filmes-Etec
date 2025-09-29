<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contato;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class usuarioController extends Controller
{

public function login(Request $request)
{
    
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'senha' => ['required'],
    ]);

    
    $loginCredentials = [
        'email' => $credentials['email'],
        'password' => $credentials['senha'],
    ];

    
    if (Auth::attempt($loginCredentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->tipo === 'admin') {
            return redirect()->intended(route('dashboard'));
        }

        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
    ])->onlyInput('email');
}
    
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:contatos',
            'senha' => 'required|string|min:6|max:20',
            'cpf' => 'required|string|max:20|unique:contatos',
            'telefone' => 'required|string|max:20',
            'tipo' => 'sometimes|in:cliente,admin',
            'deleted' => 'sometimes|in:0,1'
        ]);
       if ($validator->fails()) {
            return response()->json([
                'message' => 'Erro de validação',
                'errors' => $validator->errors()
            ], 422);
        }

        
        $data = $validator->validated();

        
        $data['senha'] = Hash::make($data['senha']);

        
        $contato = Contato::create($data);

        
        $message = ($data['tipo'] ?? 'cliente') === 'admin'
            ? 'Contato administrativo cadastrado com sucesso!'
            : 'Cadastro realizado com sucesso!';

        
        return response()->json([
            'message' => $message,
            'data' => $contato
        ], 201);
    }

}
