<?php

namespace Database\Seeders;

use App\Models\Setores;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SetoresSeeder extends Seeder
{
    const __SETORES__ = [
        "Medicamentos",
        "Vida Saudável",
        "Mamãe e bebê",
        "Beleza",
        "Cabelo",
        "Higiene Pessoal"
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        foreach (self::__SETORES__ as $setor) {
            Setores::create(["nome" => $setor]);
        }
    }
}
