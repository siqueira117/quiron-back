<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    const __CATEGORIAS__ = [
        SetoresSeeder::__SETORES__["Medicamentos"] => [
            "Tratamento em casa"        => 1,
            "Primeiros Socorros"        => 2,
            "Medicina Natural"          => 3,
            "Monitores e testes"        => 4,
            "Remédios"                  => 5,
            "Ortopédicos"               => 6,
            "Medicamentos Especiais"    => 7
        ],
        SetoresSeeder::__SETORES__["Vida Saudável"] => [
            "Vitaminas"                             => 8,
            "Lanches rápidos"                       => 9,
            "Pré e pós treino"                      => 10,
            "Acessórios para exercícios e treinos"  => 11,
            "Bebidas"                               => 12,
            "Sono"                                  => 13,
            "Saúde digestiva"                       => 14
        ],
        SetoresSeeder::__SETORES__["Mamãe e bebê"] => [
            "Troca de fraldas"              => 15,
            "Amamentação"                   => 16,
            "Alimentação infantil"          => 17,
            "Banho infantil"                => 18,
            "Higiene bucal infantil"        => 19,
            "Cuidados para pele infantil"   => 20,
            "Cuidado para as mães"          => 21,
            "Acessórios para bebês"         => 22,
            "Primeiros Socorros"            => 23,
            "Futuras mães"                  => 24,
            "Passeio"                       => 25
        ],
        SetoresSeeder::__SETORES__["Beleza"] => [
            "Perfumes"                      => 26,
            "Cuidados com a pele"           => 27,
            "Dermocosméticos"               => 28,
            "Maquiagem"                     => 29,
            "Tipos de pele"                 => 30,
            "Tratamentos para a pele"       => 31,
            "Produtos veganos e naturais"   => 32,
            "Nutricosméticos"               => 33,
            "Produtos para unhas"           => 34
        ],
        SetoresSeeder::__SETORES__["Cabelo"] => [
            "Produtos para cabelo"          => 35,
            "Tipo de cabelo"                => 36,
            "Tinturas e descolarante"       => 37,
            "Tratamentos capilares"         => 38,
            "Acessórios para cabelo"        => 39,
            "Produtos naturais e veganos"   => 40
        ],
        SetoresSeeder::__SETORES__["Higiene Pessoal"] => [
            "Higiene diária"        => 41,
            "Desodorante"           => 42,
            "Higiene bucal"         => 43,
            "Cuidados com o corpo"  => 44,
            "Saúde sexual"          => 45,
            "Cuidados com a barba"  => 46,
            "Cuidados íntimos"      => 47
        ]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::__CATEGORIAS__ as $setorID => $categorias) {
            foreach ($categorias as $categoriaNome => $categoriaID) {
                Categoria::create([
                    "id"        => $categoriaID, 
                    "nome"      => $categoriaNome, 
                    "setor_id"  => $setorID
                ]);
            }
        }
    }
}
