<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser atribuídos em massa.
     */
    protected $fillable = [
        'nome',
    ];

    /**
     * A relação muitos-para-muitos com Filme.
     * Uma categoria pode ter vários filmes.
     */
    public function filmes()
    {
        return $this->belongsToMany(Filme::class);
    }
}