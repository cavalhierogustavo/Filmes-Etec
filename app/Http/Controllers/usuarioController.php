<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contato;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // Essencial para gerenciar arquivos

class usuarioController extends Controller
{
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
            ], 422); // Código 422 indica erro de validação
        }

        // 3. <-- CORREÇÃO: Pegar os dados validados
        $data = $validator->validated();

        // 4. <-- CORREÇÃO: Criptografar a senha antes de salvar
        $data['senha'] = Hash::make($data['senha']);

        // 5. Criar o contato no banco de dados
        $contato = Contato::create($data);

        // 6. Preparar a mensagem de sucesso
        $message = ($data['tipo'] ?? 'cliente') === 'admin'
            ? 'Contato administrativo cadastrado com sucesso!'
            : 'Cadastro realizado com sucesso!';

        // 7. Retornar a resposta de sucesso
        return response()->json([
            'message' => $message,
            'data' => $contato
        ], 201); // Código 201 indica que um recurso foi criado
    }

}
