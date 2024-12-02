<?php

use Database\Seeders\SetoresSeeder;
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
        Schema::create('tbl_setores', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 200);
            $table->timestamps();
            $table->softDeletes();
        });

        $setores = new SetoresSeeder();
        $setores->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_setores');
    }
};
