<?php

use Database\Seeders\CategoriaSeeder;
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
        Schema::create('tbl_categorias', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 200);
            $table->timestamps();
            $table->softDeletes();
            
            $table->unsignedBigInteger('setor_id');
            $table->foreign('setor_id')->references('id')->on('tbl_setores')->cascadeOnDelete();
        });

        $categoria = new CategoriaSeeder();
        $categoria->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_categorias');
    }
};
