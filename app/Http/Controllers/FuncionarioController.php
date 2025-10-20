<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Filme;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Response; // opcional, mas não usado diretamente

class FuncionarioController extends Controller
{

    public function pdf()
{
    $filmes = Filme::where('deleted', false)->get();
    $categorias = Categoria::all(); // ou DB::select('SELECT * FROM categorias');

    $pdf = PDF::loadView('pdf.relatorio-filmes-categorias', compact('filmes', 'categorias'));

    // Para baixar automaticamente:
    return $pdf->download('relatorio_filmes_categorias.pdf');

    // OU, para apenas exibir no navegador:
    // return $pdf->stream('relatorio_filmes_categorias.pdf');
}
    public function index()
    {
        // Melhor usar Eloquent em vez de SQL bruto
        $filmes = Filme::where('deleted', false)->get(); // ou ->all() se quiser todos

        return view('dashboard', compact('filmes'));
    }

    // ... outros métodos (create, store, etc.) podem permanecer vazios por enquanto

    public function download()
    {
        // Busca os filmes (excluindo os "deletados", se for o caso)
        $filmes = Filme::where('deleted', false)->get();

        $filename = 'filmes.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($filmes) {
            $file = fopen('php://output', 'w');

            
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            
            fputcsv($file, [
                'ID',
                'Título',
                'Ano de Lançamento',
                'Diretor',
                'Sinopse'
            ], ';');

            
            foreach ($filmes as $filme) {
                fputcsv($file, [
                    $filme->id,
                    $filme->titulo,
                    $filme->ano_lancamento,
                    $filme->diretor,
                    $filme->sinopse
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    
public function downloadCategorias()
{
    $sql = 'SELECT * FROM categorias';
    $queryJson = DB::select($sql);

    $filename = 'categorias.csv';

    $headers = [
        'Content-Type' => 'text/csv;charset=utf-8',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ];

    $callback = function () use ($queryJson) {
        $file = fopen('php://output', 'w');

        // Cabeçalho
        $col1 = "ID";
        $col2 = mb_convert_encoding("Nome", "ISO-8859-1");
        fwrite($file, "$col1;$col2;");

        foreach ($queryJson as $d) {
            $data1 = $d->id;
            $data2 = mb_convert_encoding($d->nome, "ISO-8859-1");
            fwrite($file, "\n$data1;$data2;");
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
}