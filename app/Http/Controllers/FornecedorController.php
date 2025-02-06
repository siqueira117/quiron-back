<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\{Logger, Response};
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;


class FornecedorController extends Controller
{
    public function index() {
        try {
            Logger::openLog("fornecedor-index");
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");
        
            $fornecedores       = Fornecedor::all();
            $responseJSON   = Response::index($fornecedores);
            
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
            Logger::openLog("fornecedor-store-".tenant("id"));
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");

            $fornecedor   = new CreateFornecedor(); 
            $validated = Validator::make($request->all(), $fornecedor->rules());

            if (!$validated->passes()) {
                $responseJSON = Response::validationError($validated->errors()->all());
                Logger::register(LOG_ERR, __METHOD__ . " - Erro de validação - " . json_encode($responseJSON));
                return response()->json($responseJSON, 400);
            }

          
            DB::beginTransaction();
          
            $fornecedor = Fornecedor::create([
                "nome"                  => $request["nome"],
                "cnpj"                  => $request["cnpj"],
                "email"                 => $request["email"],
                "tel_celular"           => $request["tel_celular"]
            ]);

            DB::commit();

            $responseJSON = Response::store($fornecedor);
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
}
