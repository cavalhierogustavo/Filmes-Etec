<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser atribuídos em massa.
     */
    protected $fillable = [
        'titulo',
        'ano_lancamento',
        'diretor',
        'sinopse',
        'cartaz_path',
    ];

    /**
     * A relação muitos-para-muitos com Categoria.
     * Um filme pode ter várias categorias.
     */
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class);
    }
}