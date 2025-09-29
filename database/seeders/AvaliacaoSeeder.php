<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Avaliacao;
use App\Models\Filme;


class AvaliacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Avaliacao::truncate();

        // Pega todos os IDs dos filmes existentes
        $filmes = Filme::pluck('id');

        if ($filmes->isEmpty()) {
            $this->command->info('Nenhum filme encontrado para criar avaliações.');
            return;
        }

        $avaliacoes = [];

        // Cria 50 avaliações aleatórias
        for ($i = 0; $i < 50; $i++) {
            $avaliacoes[] = [
                'filme_id' => $filmes->random(),
                'nota' => rand(50, 100) / 10.0, // Gera notas de 5.0 a 10.0
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insere todas as avaliações de uma vez para melhor performance
        Avaliacao::insert($avaliacoes);
    }
}