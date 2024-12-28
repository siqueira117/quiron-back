<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Helpers\Response;
use App\Models\Subcategoria;
use Illuminate\Http\JsonResponse;

class SubcategoriaController extends Controller
{
    /**
     * @OA\Get(
     *      path="/subcategorias",
     *      operationId="getSubcategoriaList",
     *      tags={"Subcategorias"},
     *      summary="Retorna todas as subcategorias cadastradas",
     *      description="Retorna todas as subcategorias cadastradas",
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
        
            $subcategorias  = Subcategoria::with("categoria")->get();
            $responseJSON   = Response::index($subcategorias);
    
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
}
