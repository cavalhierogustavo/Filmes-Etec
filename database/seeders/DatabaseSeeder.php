<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema; // <-- ADICIONE ESTA LINHA


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Desabilita a verificação de chaves estrangeiras
        Schema::disableForeignKeyConstraints();

        $this->call([
            CategoriaSeeder::class,
            FilmeSeeder::class,
            AvaliacaoSeeder::class,
        ]);

        // Habilita a verificação novamente
        Schema::enableForeignKeyConstraints();
    }
}