<?php

use Database\Seeders\EntregadorSeeder;
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
        Schema::create('tbl_entregadores', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 200);
            $table->string("tel_celular", 11);
            $table->timestamps();
            $table->softDeletes();
        });

        $entregador = new EntregadorSeeder();
        $entregador->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_entregadores');
    }
};
