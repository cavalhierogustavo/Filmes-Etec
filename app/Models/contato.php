<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// NOME DA CLASSE: Contato (maiúsculo)
class Contato extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // CORREÇÃO: 'CPF' para 'cpf', para bater com o banco de dados
    protected $fillable = ['nome', 'email', 'senha', 'telefone', 'cpf','tipo','deleted'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'senha', // É uma boa prática não retornar a senha em respostas de API
    ];
}
