<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FarmaciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('responsaveis')->insert([
            'nome' => 'João da Silva',
            'email' => 'joao@silva.com',
            'telefone' => '021999999999',
        ]);

        DB::table('farmacias')->insert([
            'nome' => 'ofertao farmacias belford purple',
            'nome_visualizacao' => 'ofertao',
            'cnpj' => '00000000000000',
            'cep' => '00000000',
            'logradouro' => 'RUA JUNO DE TAL',
            'complemento' => 'CASA 985',
            'numero' => 123,
            'bairro' => 'LUZ',
            'cidade' => 'NOVA IGUACU',
            'uf' => 'RJ',
            'responsavel_id' => 1,
        ]);
    }
}
