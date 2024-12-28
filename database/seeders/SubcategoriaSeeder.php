<?php

namespace Database\Seeders;

use App\Models\Subcategoria;
use Illuminate\Database\Seeder;

class SubcategoriaSeeder extends Seeder
{
    const __SUBCATEGORIA__ = [
        // MEDICAMENTOS
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Medicamentos"]]["Tratamento em casa"] => [
            "Inaladores"                                => 1,
            "Seringas descartáveis"                     => 2,
            "Equipamentos de proteção"                  => 3,
            "Equipamentos e instrumentos hospitalares"  => 4,
            "Camas, colchões e almofadas"               => 5,
            "Dilatador Nasal"                           => 6
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Medicamentos"]]["Primeiros Socorros"] => [
            "Curativos"                             => 7,
            "Algodão"                               => 8,
            "Soros"                                 => 9,
            "Contusões e machucados"                => 10,
            "Higienizadores"                        => 11,
            "Acessórios para primeiros socorros"    => 12
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Medicamentos"]]["Medicina Natural"] => [
            "Florais"           => 13,
            "Ayurveda"          => 14,
            "Fitoterápicos"     => 15,
            "Calmantes"         => 16,
            "Homeopatia"        => 17,
            "Remédios naturais" => 18,
            "Aromaterapia"      => 19,
            "Canabidiol"        => 20
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Medicamentos"]]["Monitores e testes"] => [
            "Monitores de pressão"  => 21,
            "Medidores de glicose"  => 22,
            "Canetas de insulina"   => 23,
            "Termômetros"           => 24,
            "Oxímetros"             => 25,
            "Baterias"              => 26,
            "Testes"                => 27
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Medicamentos"]]["Remédios"] => [
            "Anti-inflamatórios"                => 28,
            "Antidepressivos"                   => 29,
            "Para parar de fumar"               => 30,
            "Pílulas anticoncepcionais e DIU"   => 31,
            "Para gripe e resfriado"            => 33,
            "Para diabetes"                     => 34,
            "Para gastrite"                     => 35,
            "Para asma"                         => 36,
            "Para enxaqueca"                    => 37,
            "Para dor de garganta"              => 38,
            "Para dor e febre"                  => 39,
            "Para tosse"                        => 40,
            "Para azia e má digestão"           => 41,
            "Para infecções"                    => 42,
            "Para rinite e sinusite"            => 43,
            "Para insônia"                      => 44,
            "Para tireoide"                     => 45,
            "Para alergias"                     => 46,
            "Para a visão"                      => 47,
            "Para infecção urinária"            => 48,
            "Para colesterol"                   => 49,
            "Para pressão alta"                 => 50,
            "Controle de peso"                  => 51
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Medicamentos"]]["Ortopédicos"] => [
            "Joelheiras e tornozeleiras"        => 52, 
            "Munhequeiras e cotoveleiras"       => 53,
            "Tipoias e colar cervical"          => 54,
            "Muletas e bengalas"                => 55,
            "Botas ortopédicas"                 => 56,
            "Meias de compressão e cintas"      => 57,
            "Para lesões, luxações e torções"   => 58,
            "Massageadores"                     => 59
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Medicamentos"]]["Medicamentos Especiais"] => [
            "Endocrinologia"        => 60,
            "Ginecologia"           => 61,
            "Infertilidade"         => 62,
            "Oncologia"             => 63,
            "Reumatologia"          => 64,
            "Clínica Geral"         => 65,
            "Outras especialidades" => 66
        ],
        // =========================

        // VIDA SAUDAVEL
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Vida Saudável"]]["Vitaminas"] => [
            "Multivitaminas"            => 67,
            "Vitamina D"                => 68,
            "Vitamina C"                => 69,
            "Estimulante de apetite"    => 70,
            "Cálcio"                    => 71,
            "Colágeno"                  => 72,
            "Vitamina E"                => 73,
            "Monovitaminas gestantes"   => 74,
            "Minerais"                  => 75,
            "Vitamina B"                => 76,
            "D + Cálcio"                => 77,
            "Omega 3"                   => 78,
            "Complementos alimentares"  => 79
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Vida Saudável"]]["Lanches rápidos"] => [
            "Barras de Proteína"        => 80,
            "Chocolates e doces"        => 81,
            "Adoçantes"                 => 82,
            "Balas e gomas de mascar"   => 83,
            "Alimentos funcionais"      => 84,
            "Cereais em barra"          => 85,
            "Snacks"                    => 86
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Vida Saudável"]]["Pré e pós treino"] => [
            "Barras de Proteína"    => 87,
            "Whey Protein"          => 88,
            "Glutamina"             => 89,
            "Emagrecedores"         => 90,
            "Pré treino"            => 91,
            "Pastas"                => 92,
            "Alimentos proteicos"   => 93,
            "Creatina"              => 94,
            "BCAA"                  => 95
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Vida Saudável"]]["Acessórios para exercícios e treinos"] => [
            "Balanças"                      => 96,
            "Produtos ortopédicos"          => 97,
            "Acessórios para treino"        => 98,
            "Bandagem adesiva"              => 99,
            "Equipamentos aeróbicos"        => 100,
            "Equipamentos para musculação"  => 101
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Vida Saudável"]]["Bebidas"] => [
            "Isotônicos e energéticos"      => 102,
            "Leites e Compostos Lácteos"    => 103,
            "Shakes"                        => 104,
            "Água de coco"                  => 105,
            "Energéticos em cápsula"        => 106,
            "Sucos"                         => 107,
            "Complementos em caixa"         => 108,
            "Chás"                          => 109,
            "Complementos em lata"          => 110,
            "Água"                          => 111,
            "Bebidas funcionais"            => 112
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Vida Saudável"]]["Sono"] => [
            "Umidificadores"        => 113,
            "Dilatadores nasais"    => 114,
            "Chás"                  => 115,
            "Triptofano"            => 116,
            "Calmantes"             => 117,
            "Florais"               => 118,
            "Aromaterapia"          => 119
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Vida Saudável"]]["Saúde digestiva"] => [
            "Fibras"                => 120,
            "Probióticos"           => 121,
            "Enzimas digestivas"    => 122
        ],
        // =========================
        
        // MAMÃE E BEBÊ 
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Mamãe e bebê"]]["Troca de fraldas"] => [
            "Fraldas infantis"          => 123,
            "Pomadas para assaduras"    => 124,
            "Lenços umedecidos"         => 125,
            "Algodão"                   => 126,
            "Talcos para bebês"         => 127
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Mamãe e bebê"]]["Amamentação"] => [
            "Mamadeiras"                        => 128,
            "Bicos para mamadeiras"             => 129,
            "Protetores e pomadas para seios"   => 130,
            "Absorventes para seios"            => 131,
            "Bomba de leite"                    => 132
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Mamãe e bebê"]]["Alimentação infantil"] => [
            "Fórmulas infantis 0-6 meses"                   => 133,
            "Fórmulas infantis 6-12 meses"                  => 134,
            "Leites infantis 1-3 anos"                      => 135,
            "Leites infantis mais de 3 anos"                => 136,
            "Fórmulas infantis com restrições alimentares"  => 137,
            "Leites infantis com restrições alimentares"    => 138,
            "Suplementos infantis"                          => 139,
            "Papinhas e lanches infantis"                   => 140,
            "Vitaminas infantis"                            => 141
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Mamãe e bebê"]]["Banho infantil"] => [
            "Shampoos infantis"                 => 142,
            "Condicionadores infantis"          => 143,
            "Sabonete infantil"                 => 144,
            "Creme e gel para cabelo infantil"  => 145,
            "Colônias e perfumes infantis"      => 146,
            "Hastes flexíveis"                  => 147,
            "Acessórios para banho"             => 148
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Mamãe e bebê"]]["Higiene bucal infantil"] => [
            "Enxaguante bucal infantil"         => 149,
            "Escova de dente infantil"          => 150,
            "Pasta de dente infantil"           => 151,
            "Fio dental infantil"               => 152,
            "Acessórios higiene bucal infantil" => 153
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Mamãe e bebê"]]["Cuidados para pele infantil"] => [
            "Óleos e hidratantes corporais infantis"    => 154,
            "Protetor solar infantil"                   => 155,
            "Repelente infantil"                        => 156
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Mamãe e bebê"]]["Cuidado para as mães"] => [
            "Absorventes para seios"            => 157,
            "Protetores e pomadas para seios"   => 158,
            "Cremes para estrias"               => 159,
            "Hidratantes para a pele"           => 160,
            "Vitaminas"                         => 161,
            "Absorventes"                       => 162
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Mamãe e bebê"]]["Acessórios para bebês"] => [
            "Chupetas e prendedores"        => 163,
            "Acessórios para alimentação"   => 164,
            "Mordedores"                    => 165,
            "Escovas para cabelos infantis" => 166,
            "Aquecedor de mamadeiras"       => 167,
            "Cadeiras e cadeirões"          => 168,
            "Banheiras e Suportes"          => 169
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Mamãe e bebê"]]["Primeiros Socorros"] => [
            "Band aids, compressas e bandagens" => 170,
            "Aspirador nasal"                   => 171,
            "Algodão"                           => 172,
            "Termômetros e outros acessórios"   => 173,
            "Antissépticos"                     => 174
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Mamãe e bebê"]]["Futuras mães"] => [
            "Vitaminas para engravidar" => 175,
            "Testes de fertilidade"     => 176,
            "Testes de gravidez"        => 177
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Mamãe e bebê"]]["Passeio"] => [
            "Carrinho de bebê"              => 178,
            "Bebê Conforto"                 => 179,
            "Carrinho com bebê conforto"    => 180,
            "Cadeirinha para auto"          => 181,
            "Acessórios para passeio"       => 182
        ],
        // =========================

        // BELEZA
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Beleza"]]["Perfumes"] => [
            "Feminino"  => 183,
            "Masculino" => 184,
            "Unissex"   => 185,
            "Infantil"  => 186
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Beleza"]]["Cuidados com a pele"] => [
            "Rosto"             => 187,
            "Corpo"             => 188,
            "Mãos"              => 189,
            "Pés"               => 190,
            "Olhos"             => 191,
            "Lábios"            => 192,
            "Protetor solar"    => 193,
            "Máscara facial"    => 194,
            "Maternidade"       => 195
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Beleza"]]["Dermocosméticos"] => [
            "Corpo"             => 196,
            "Lábios"            => 197,
            "Rosto"             => 198,
            "Mãos e pés"        => 199,
            "Olhos"             => 200,
            "Protetor solar"    => 201,
            "Esfoliantes"       => 202,
            "Máscara facial"    => 203
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Beleza"]]["Maquiagem"] => [
            "Rosto"                     => 204,
            "Lábios"                    => 205,
            "Olhos"                     => 206,
            "Acessórios para beleza"    => 207,
            "Demaquilantes"             => 208
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Beleza"]]["Tipos de pele"] => [
            "Normal"    => 209,
            "Seca"      => 210,
            "Oleosa"    => 211,
            "Mista"     => 212
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Beleza"]]["Tratamentos para a pele"] => [
            "Tratamento antiacne"   => 213,
            "Anti-idade"            => 214,
            "Nutricosméticos"       => 215
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Beleza"]]["Produtos veganos e naturais"] => [
            "Rosto"             => 216,
            "Corpo"             => 217,
            "Maquiagem"         => 218,
            "Limpeza de pele"   => 219
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Beleza"]]["Nutricosméticos"] => [
            "Anticelulite e firmadores" => 220,
            "Antienvelhecimento"        => 221,
            "Redutores de medidas"      => 222,
            "Para cabelos e unhas"      => 223
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Beleza"]]["Produtos para unhas"] => [
            "Algodão"                               => 224,
            "Bases e fortificantes para a unhas"    => 225,
            "Esmaltes"                              => 226,
            "Removedores de esmaltes"               => 227,
            "Unhas postiças"                        => 228,
            "Cortadores de unha e tesouras"         => 229,
            "Lixas e alicates"                      => 230,
            "Bases e cremes para tratamento"        => 231
        ],
        // =========================

        // CABELO
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Cabelo"]]["Produtos para cabelo"] => [
            "Shampoo"                               => 232,
            "Condicionador"                         => 233,
            "Máscara"                               => 234,
            "Cremes de pentear e leave-in"          => 235,
            "Ceras e pomadas modeladoras"           => 236,
            "Produtos e acessórios profissionais"   => 237,
            "Finalizadores"                         => 238
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Cabelo"]]["Tipo de cabelo"] => [
            "Secos ou ressecados"       => 239,
            "Oleosos ou mistos"         => 240,
            "Cacheados ou ondulados"    => 241,
            "Loiros ou com luzes"       => 242,
            "Coloridos"                 => 243,
            "Com Frizz"                 => 244,
            "Com escova progressiva"    => 245,
            "Danificados"               => 246,
            "Brancos e Grisalhos"       => 247
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Cabelo"]]["Tinturas e descolarante"] => [
            "Coloração permanente"  => 248,
            "Coloração temporária"  => 249,
            "Tonalizantes"          => 250,
            "Descolorantes"         => 251
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Cabelo"]]["Tratamentos capilares"] => [
            "Tratamento anticaspa"          => 252,
            "Tratamento antiqueda"          => 253,
            "Shampoo dermo"                 => 254,
            "Máscaras para cabelo"          => 255,
            "Nutricosméticos para cabelos"  => 256
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Cabelo"]]["Acessórios para cabelo"] => [
            "Secadores"                     => 257,
            "Chapinhas e modeladores"       => 258,
            "Escovas de cabelo e pentes"    => 259,
            "Elásticos e presilhas"         => 260,
            "Acessórios para corte"         => 261
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Cabelo"]]["Produtos naturais e veganos"] => [
            "Shampoos"          => 262,
            "Condicionadores"   => 263,
            "Tratamentos"       => 264,
            "Finalizadores"     => 265
        ],
        // =========================

        // HIGIENE DIÁRIA
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Higiene Pessoal"]]["Higiene diária"] => [
            "Shampoo"           => 266,
            "Sabonetes"         => 267,
            "Condicionadores"   => 268,
            "Absorventes"       => 269
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Higiene Pessoal"]]["Desodorante"] => [
            "Desodorante aerosol"           => 270,
            "Desodorante roll-on"           => 271,
            "Desodorante stick"             => 272,
            "Desodorante creme"             => 273,
            "Desodorante natural e vegano"  => 274,
            "Desodorante clinical"          => 275
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Higiene Pessoal"]]["Higiene bucal"] => [
            "Escova de dente"               => 276,
            "Pasta de dente"                => 277,
            "Acessórios de higiene bucal"   => 278,
            "Enxaguante bucal"              => 279,
            "Fio dental"                    => 280,
            "Fixadores para dentadura"      => 281
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Higiene Pessoal"]]["Cuidados com o corpo"] => [
            "Repelentes"            => 282,
            "Corpo"                 => 283,
            "Rosto"                 => 284,
            "Protetor solar"        => 285,
            "Cuidados com os pés"   => 286,
            "Depilação"             => 287
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Higiene Pessoal"]]["Saúde sexual"] => [
            "Camisinhas"                    => 288,
            "Lubrificantes"                 => 289,
            "Acessórios para saúde sexual"  => 290
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Higiene Pessoal"]]["Cuidados com a barba"] => [
            "Lâminas e aparelhos de barbear"    => 291,
            "Shampoo para barba"                => 292,
            "Gel e espumas de barbear"          => 293,
            "Pós barba"                         => 294,
            "Modeladores e pomadas para barba"  => 295
        ],
        CategoriaSeeder::__CATEGORIAS__[SetoresSeeder::__SETORES__["Higiene Pessoal"]]["Cuidados íntimos"] => [
            "Absorventes para incontinência"    => 296,
            "Fraldas geriátricas"               => 297,
            "Lenços umedecidos e pomadas"       => 298,
            "Roupa Intima"                      => 299,
            "Absorventes"                       => 300,
            "Sabonetes íntimos"                 => 301
        ],
        // =========================
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::__SUBCATEGORIA__ as $categoriaID => $subcategorias) {
            foreach ($subcategorias as $subcategoriaNome => $subcategoriaID) {
                Subcategoria::create([
                    "id"            => $subcategoriaID, 
                    "nome"          => $subcategoriaNome, 
                    "categoria_id"  => $categoriaID
                ]);
            }
        }
    }
}
