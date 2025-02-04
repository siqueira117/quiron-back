<?php

namespace App\Http\Controllers;

use App\Helpers\{Logger, Response};
use App\Http\Requests\CreateProduto;
use App\Models\Produto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProdutoController extends Controller
{
    public function index() {
        try {
            Logger::openLog("produto-index");
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");
        
            $produtos       = Produto::all();
            $responseJSON   = Response::index($produtos);
            
            Logger::register(LOG_NOTICE, "Response: " . json_encode($responseJSON));
            Logger::register(LOG_NOTICE, __METHOD__ . "::OK");
            return response()->json($responseJSON, 200);                
        } catch (\Exception $e) {
            Logger::register(LOG_ERR, "ERROR: " . $e->getMessage() . " | FILE: " . $e->getFile() . " : " . $e->getLine());
            return response()->json([
                "retcode" => -1,
                "message" => $e->getMessage()
            ], 500);                
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            Logger::openLog("produto-store-".tenant("id"));
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");

            // Realiza as validações necessárias
            $produto   = new CreateProduto(); 
            $validated = Validator::make($request->all(), $produto->rules());

            if (!$validated->passes()) {
                $responseJSON = Response::validationError($validated->errors()->all());
                Logger::register(LOG_ERR, __METHOD__ . " - Erro de validação - " . json_encode($responseJSON));
                return response()->json($responseJSON, 400);
            }
            // ===================================

            // Guarda imagem no storage local
            $file = $request->file('imagem');
            $url = $this->addImageOnStorage($file);
            $imgUri = parse_url($url)["path"];
            // ===================================

            DB::beginTransaction();

            // Cria produto
            $produto = Produto::create([
                "nome"                  => $request["nome"],
                "valor"                 => $request["valor"],
                "descricao"             => $request["descricao"],
                "img_uri"               => $imgUri,
                "sku"                   => $request["sku"]                  ?? null,
                "ean"                   => $request["ean"]                  ?? null,
                "detalhes"              => $request["detalhes"]             ?? null,
                "estoque_quantidade"    => $request["estoque_quantidade"]   ?? null,
                "subcategoria_id"       => $request["subcategoria_id"]      ?? null
            ]);
            // ===================================

            if ($request["estoque_quantidade"]) {
                $estoqueProdutoID = ProdutoEstoqueController::addEstoque($produto->id, $request["estoque_quantidade"]);
                MovimentacaoEstoqueController::addMovimentacao(
                    $estoqueProdutoID, 
                    $request["estoque_quantidade"], 
                    MovimentacaoEstoqueController::OPER_ENTRADA
                );
            }

            DB::commit();

            $responseJSON = Response::store($produto);
            Logger::register(LOG_NOTICE, __METHOD__ . "::END");
            return response()->json($responseJSON, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Logger::register(LOG_ERR, "ERROR: " . $e->getMessage() . " | FILE: " . $e->getFile() . " : " . $e->getLine());
            return response()->json([
                "retcode" => -1,
                "message" => $e->getMessage()
            ], 500);  
        }
    }

    private function addImageOnStorage(UploadedFile $file): string
    {
        // Recupera tenant usado
        $tenant = tenant();
            
        $stored = Storage::disk('public')->put("tenants/{$tenant->id}/produtos", $file);
        return tenant_asset($stored);
    }

    public function show(string $id): JsonResponse
    {
        try {
            Logger::openLog(__CLASS__."-".__FUNCTION__);
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");

            $return = DB::select("CALL getProdutoComCategoria(?)", [$id]);
            $responseJSON = Response::show($return);
            Logger::register(LOG_NOTICE, __METHOD__ . "::END");
            return response()->json($responseJSON, 200);
        } catch (\Exception $e) {
            Logger::register(LOG_ERR, "ERROR: " . $e->getMessage() . " | FILE: " . $e->getFile() . " : " . $e->getLine());
            return response()->json([
                "retcode" => -1,
                "message" => $e->getMessage()
            ], 500);  
        }
    }
}
