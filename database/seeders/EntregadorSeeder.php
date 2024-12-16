<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntregadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('tbl_entregadores')->insert([
            'nome' => 'Marcio Gomes',
            'tel_celular' => '21998876532',
        ]);
    }
}
