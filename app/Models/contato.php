<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Contato extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'email',
        'senha',
        'cpf',
        'telefone',
        'tipo',
        'deleted',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'senha',
        'remember_token',
    ];

    /**
     * Pega a senha para o usuário autenticado.
     * Isso informa ao Laravel que sua coluna de senha se chama 'senha' e não 'password'.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->senha;
    }
}