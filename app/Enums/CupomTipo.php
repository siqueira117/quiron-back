<?php

namespace App\Enums;

enum CupomTipo: string 
{
    case Porcentagem = 'porcentagem';
    case Valor = 'valor';
    case TaxaEntregaGratis = 'taxa_entrega_gratis';
}