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
        Schema::create('tbl_produtos_estoque', function (Blueprint $table) {
            $table->id();
            $table->integer("quantidade");

            $table->unsignedBigInteger('produto_id');
            $table->foreign('produto_id')->references('id')->on('tbl_produtos');

            $table->timestamps();
            $table->softDeletes();        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_produtos_estoque');
    }
};
