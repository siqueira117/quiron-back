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
        Schema::create('farmacias', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 150);
            $table->string('nome_visualizacao', 150);
            $table->char('cnpj', 14);
            $table->char('cep', 14);
            $table->string('logradouro', 150);
            $table->string('complemento');
            $table->integer('numero');
            $table->string('bairro', 150);
            $table->string('cidade', 150);
            $table->char('uf', 2);
            $table->timestamps();

            $table->unsignedBigInteger('responsavel_id')->unique();
            $table->foreign('responsavel_id')->references('id')->on('responsaveis')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmacias');
    }
};
