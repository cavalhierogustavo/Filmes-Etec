<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Filme;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class FilmeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpa as tabelas para evitar dados inconsistentes
        Filme::truncate();
        DB::table('categoria_filme')->truncate();

        // Pega todas as categorias para associar aos filmes
        $categorias = Categoria::all();

        // Criação dos filmes (sem o caminho do cartaz aqui)
        $filmes = [
            [
                'titulo' => 'O Poderoso Chefão',
                'ano_lancamento' => 1972,
                'diretor' => 'Francis Ford Coppola',
                'sinopse' => 'A saga da família Corleone, uma das mais poderosas da máfia italiana em Nova York.',
                'deleted' => '0'
            ],
            [
                'titulo' => 'A Origem',
                'ano_lancamento' => 2010,
                'diretor' => 'Christopher Nolan',
                'sinopse' => 'Um ladrão que rouba informações ao entrar nos sonhos das pessoas recebe a tarefa inversa: plantar uma ideia.',
                'deleted' => '0'
            ],
            [
                'titulo' => 'Matrix',
                'ano_lancamento' => 1999,
                'diretor' => 'Lana & Lilly Wachowski',
                'sinopse' => 'Um jovem programador descobre que sua realidade é uma simulação e se junta a uma rebelião.',
                'deleted' => '0'
            ],
            [
                'titulo' => 'Pulp Fiction: Tempo de Violência',
                'ano_lancamento' => 1994,
                'diretor' => 'Quentin Tarantino',
                'sinopse' => 'Várias histórias interligadas de crime e redenção em Los Angeles.',
                'deleted' => '0'
            ],
            [
                'titulo' => 'A Viagem de Chihiro',
                'ano_lancamento' => 2001,
                'diretor' => 'Hayao Miyazaki',
                'sinopse' => 'Uma jovem garota se perde em um mundo de deuses, espíritos e monstros.',
                'deleted' => '0'
            ],
            [
                'titulo' => 'Parasita',
                'ano_lancamento' => 2019,
                'diretor' => 'Bong Joon Ho',
                'sinopse' => 'Uma família pobre se infiltra na vida de uma família rica, com consequências inesperadas.',
                'deleted' => '0'
            ],
            [
                'titulo' => 'O Senhor dos Anéis: A Sociedade do Anel',
                'ano_lancamento' => 2001,
                'diretor' => 'Peter Jackson',
                'sinopse' => 'Um hobbit herda um anel poderoso e deve embarcar em uma jornada perigosa para destruí-lo.',
                'deleted' => '0'
            ],
        ];

        // MUDANÇA AQUI: Modificamos o loop para pegar o índice ($key) de cada filme
        foreach ($filmes as $key => $filmeData) {
            
            // 1. Gera o nome do arquivo da imagem sequencialmente (imagem1.png, imagem2.png, etc.)
            // O $key começa em 0, então somamos 1.
            $caminhoCartaz = 'public/cartazes/imagem' . ($key + 1) . '.png';

            // 2. Adiciona o caminho do cartaz ao array de dados do filme
            $filmeData['cartaz_path'] = $caminhoCartaz;
            
            // 3. Cria o filme com todos os dados, incluindo o cartaz
            $filme = Filme::create($filmeData);

            // Associa de 1 a 3 categorias aleatórias ao filme
            $categoriasAleatorias = $categorias->random(rand(1, 3))->pluck('id');
            $filme->categorias()->attach($categoriasAleatorias);
        }
    }
}