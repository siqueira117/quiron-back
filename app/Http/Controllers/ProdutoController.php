<?php

namespace App\Http\Controllers;

use App\Helpers\{Logger, Response};
use App\Http\Requests\CreateProduto;
use App\Models\Produto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

            $produto   = new CreateProduto(); 
            $validated = Validator::make($request->all(), $produto->rules());

            if (!$validated->passes()) {
                $responseJSON = Response::validationError($validated->errors()->all());
                Logger::register(LOG_ERR, __METHOD__ . " - Erro de validação - " . json_encode($responseJSON));
                return response()->json($responseJSON, 400);
            }
            
            Logger::register(LOG_NOTICE, __METHOD__ . "::OK");
            return response()->json();                
        } catch (\Exception $e) {
            Logger::register(LOG_ERR, "ERROR: " . $e->getMessage() . " | FILE: " . $e->getFile() . " : " . $e->getLine());
            return response()->json([
                "retcode" => -1,
                "message" => $e->getMessage()
            ], 500);  
        }
    }
}
