<?php

namespace App\Http\Controllers;

use App\Models\MovimentacaoEstoque;
use Illuminate\Http\Request;

class MovimentacaoEstoqueController extends Controller
{
    const OPER_ENTRADA  = "entrada";
    const OPER_SAIDA    = "saida";

    public static function addMovimentacao(int $estoqueProdutoID, int $quantidade, string $operacao): int
    {
        if (!in_array($operacao, [self::OPER_ENTRADA, self::OPER_SAIDA])) {
            throw new \Exception("Operação de movimentação não identificada");
        }

        $movimentacaoEstoque = MovimentacaoEstoque::create([
            "operacao"              => $operacao,
            "quantidade"            => $quantidade,
            "produto_estoque_id"    => $estoqueProdutoID
        ]);

        return $movimentacaoEstoque->id;
    }
}
