<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      Schema::create('avaliacoes', function (Blueprint $table) {
        $table->id();
        // Chave estrangeira para conectar com a tabela 'filmes'
        $table->foreignId('filme_id')->constrained()->onDelete('cascade');
        $table->decimal('nota', 3, 1); // Ex: 8.5
        // Você pode adicionar uma user_id aqui se quiser saber quem avaliou
        // $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacoes');
    }
};
