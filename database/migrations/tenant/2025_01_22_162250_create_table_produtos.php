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
        Schema::create('tbl_produtos', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 200);
            $table->float("valor");
            $table->text("descricao");
            $table->string("img_uri", 200)->nullable()->default(null);
            $table->string("sku", 200)->nullable()->default(null);
            $table->string("ean", 200)->nullable()->default(null);
            $table->json("detalhes")->nullable()->default(null);
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_produtos');
    }
};
