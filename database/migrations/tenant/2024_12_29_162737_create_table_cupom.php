<?php

use App\Enums\CupomStatus;
use App\Enums\CupomTipo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TABLE_NAME = "tbl_cupons";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->id('id_cupom');
            $table->enum('tipo', array_column(CupomTipo::cases(), 'value'));
            $table->string('codigo_cupom', 100);
            $table->float('valor');
            $table->enum('status', array_column(CupomStatus::cases(), 'value'))->default(CupomStatus::Ativado->value);
            $table->date('data_validade')->nullable()->default(null);
            $table->json('configuracoes')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
