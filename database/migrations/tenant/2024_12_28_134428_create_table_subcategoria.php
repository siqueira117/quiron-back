<?php

use Database\Seeders\SubcategoriaSeeder;
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
        Schema::create('tbl_subcategorias', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 200);
            $table->timestamps();
            $table->softDeletes();
            
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('tbl_categorias');
        });

        $categoria = new SubcategoriaSeeder();
        $categoria->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_subcategorias');
    }
};
