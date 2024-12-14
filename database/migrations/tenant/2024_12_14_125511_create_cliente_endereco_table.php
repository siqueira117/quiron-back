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
        Schema::create('tbl_cliente_enderecos', function (Blueprint $table) {
            $table->id();
            $table->char('cep', 14);
            $table->string('logradouro', 150);
            $table->string('complemento', 250)->nullable();
            $table->string('numero', 10);
            $table->string('bairro', 150);
            $table->string('cidade', 150);
            $table->char('uf', 2);
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('cliente_id')->unique();
            $table->foreign('cliente_id')->references('id')->on('tbl_clientes')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cliente_enderecos');
    }
};
