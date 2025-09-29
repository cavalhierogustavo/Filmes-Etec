<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->truncate();

        DB::table('categorias')->insert([
            ['nome' => 'Ação', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Comédia', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Drama', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Ficção Científica', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Terror', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Animação', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Romance', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Documentário', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
