<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Models\ProdutoEstoque as ProdutoEstoqueModel;
use Illuminate\Http\Request;

class ProdutoEstoqueController extends Controller
{
    public static function addEstoque(int $produtoID, int $estoqueQuantidade): int
    {
        // Verifica se já existe estoque criado para o produto
        $produtoEstoque = ProdutoEstoqueModel::firstWhere('produto_id', $produtoID);
        if (!$produtoEstoque) {
            Logger::register(LOG_NOTICE, "Não existe estoque para o produto, criando estoque...");

            // Cadastra estoque do produto caso o mesmo ainda não exista
            $produtoEstoque = ProdutoEstoqueModel::create([
                "quantidade" => $estoqueQuantidade,
                "produto_id" => $produtoID
            ]);
        }

        $produtoEstoque->fill(["quantidade" => $estoqueQuantidade, "produto_id" => $produtoID]);
        $produtoEstoque->save();

        return $produtoEstoque->id;
    }
}
