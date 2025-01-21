<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement(
            "CREATE VIEW AllSetorCategoriaSubcategoria AS
            SELECT 
                subcategoria.id AS id_subcategoria, 
	            subcategoria.nome AS nome_subcategoria, 
	            categoria.id AS id_categoria,
	            categoria.nome AS nome_categoria, 
	            setor.id AS id_setor,
	            setor.nome AS nome_setor
            FROM tbl_subcategorias AS subcategoria
            INNER JOIN tbl_categorias AS categoria ON categoria.id = subcategoria.categoria_id
            INNER JOIN tbl_setores AS setor ON setor.id = categoria.setor_id"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('DROP VIEW AllSetorCategoriaSubcategoria');
    }
};
