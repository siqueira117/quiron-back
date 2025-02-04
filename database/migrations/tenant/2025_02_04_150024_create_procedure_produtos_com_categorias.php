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
            "CREATE PROCEDURE getProdutoComCategoria(IN id BIGINT)
                BEGIN
                    SELECT 
                        tbl_produtos.*,	
                        tbl_subcategorias.nome AS nome_subcategoria,
                        tbl_categorias.nome AS nome_categoria,
                        tbl_setores.nome AS nome_setor
                    FROM tbl_produtos
                    INNER JOIN tbl_subcategorias 
                        ON tbl_produtos.subcategoria_id = tbl_subcategorias.id
                    INNER JOIN tbl_categorias 
                        ON tbl_subcategorias.categoria_id = tbl_categorias.id
                    INNER JOIN tbl_setores
                        ON tbl_categorias.setor_id = tbl_setores.id
                    WHERE tbl_produtos.id = id;
                END"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('DROP PROCEDURE getProdutoComCategoria');
    }
};
