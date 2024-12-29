<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Helpers\Response;
use App\Http\Requests\CreateCupom;
use App\Models\Cupom;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CupomController extends Controller
{
        /**
     * @OA\Get(
     *      path="/cupons",
     *      operationId="getCuponsList",
     *      tags={"cupons"},
     *      summary="Retorna todos os cupons cadastrados",
     *      description="Retorna todos os cupons cadastrados",
     *      @OA\Response(
     *          response=200
     *       ),
     *       @OA\Response(response=400, description="Bad request")
     *     )
     */
    public function index(): JsonResponse {
        try {
            Logger::openLog(__CLASS__."-".__FUNCTION__);
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");
        
            $cupons         = Cupom::all();
            $responseJSON   = Response::index($cupons);
    
            Logger::register(LOG_NOTICE, "Response: " . json_encode($responseJSON));
            Logger::register(LOG_NOTICE, __METHOD__ . "::OK");
            return response()->json($responseJSON, 200);                
        } catch (\Exception $e) {
            Logger::register(LOG_ERR, "ERROR: " . $e->getMessage());
            return response()->json([
                "retcode" => -1,
                "message" => $e->getMessage()
            ], 500);                
        }
    }

    /**
     * @OA\Post(
     *      path="/cupons",
     *      operationId="storeCupom",
     *      tags={"Cupons"},
     *      summary="Adiciona um registro de cupom",
     *      description="Adiciona um registro de cupom",
     *      @OA\Response(
     *          response=200
     *       ),
     *       @OA\Response(response=400, description="Bad request")
     *     )
     */
    public function store(Request $request) {
        try {
            Logger::openLog(__CLASS__."-".__FUNCTION__);
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");

            $setor      = new CreateCupom(); 
            $validated  = Validator::make($request->all(), $setor->rules());

            if (!$validated->passes()) {
                $responseJSON = Response::validationError($validated->errors()->all());                
                return response()->json($responseJSON, 400);
            }

            DB::beginTransaction();
            
            $setor = Cupom::create([
                "tipo" => $request->tipo, 
                "codigo_cupom" => $request->codigo_cupom, 
                "valor" => $request->valor
            ]);
            
            DB::commit();
            
            $responseJSON = Response::store($setor);
            Logger::register(LOG_NOTICE, __METHOD__ . "::END");
            return response()->json($responseJSON, 200);
        } catch (\Exception $e) {
            Logger::register(LOG_ERR, "ERROR: " . $e->getMessage());
            return response()->json([
                "retcode"   => -1, 
                "message"   => $e->getMessage(), 
                "code"      => $e->getCode(),
                "pid"       => Logger::getPID()
            ], 500);
        }
    }
}
