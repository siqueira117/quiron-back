<?php

namespace Database\Seeders;

use App\Models\Setor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SetoresSeeder extends Seeder
{
    const __SETORES__ = [
        "Medicamentos"      => 1,
        "Vida Saudável"     => 2,
        "Mamãe e bebê"      => 3,
        "Beleza"            => 4,
        "Cabelo"            => 5,
        "Higiene Pessoal"   => 6
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        foreach (self::__SETORES__ as $setorNome => $setorID) {
            Setor::create(["id" => $setorID, "nome" => $setorNome]);
        }
    }
}
