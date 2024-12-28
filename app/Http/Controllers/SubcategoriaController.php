<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Helpers\Response;
use App\Models\Subcategoria;
use App\Models\Views\AllSetorCatSubcat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function index(Request $request): JsonResponse {
        try {
            Logger::openLog(__CLASS__."-".__FUNCTION__);
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");
        
            $subcategorias = [];
            $defaultQuery = true;
            if ($request->query->count() !== 0 ) {
                $defaultQuery = false;
                if ($request->query("categoriaID")) {
                    $subcategorias = Subcategoria::where("categoria_id", $request->query("categoriaID"))->get(["nome"]);
                    goto DEFAULT_QUERY;
                }

                if ($request->query("withAllRelations")) {
                    $subcategorias = AllSetorCatSubcat::all();
                    goto DEFAULT_QUERY;
                }
            }

            DEFAULT_QUERY:
            if ($defaultQuery) {
                $subcategorias = Subcategoria::with("categoria")->get();
            }
            
            $responseJSON   = [];
            $httpCode       = 0;
            if ($subcategorias->isEmpty()) {
                $responseJSON   = Response::registrosNaoEncontrados();
                $httpCode       = 404;
            } else {
                $responseJSON   = Response::index($subcategorias);
                $httpCode       = 200; 
            }

            Logger::register(LOG_NOTICE, "Response: " . json_encode($responseJSON));
            Logger::register(LOG_NOTICE, __METHOD__ . "::OK");
            return response()->json($responseJSON, $httpCode);                
        } catch (\Exception $e) {
            Logger::register(LOG_ERR, "ERROR: " . $e->getMessage());
            return response()->json([
                "retcode" => -1,
                "message" => $e->getMessage()
            ], 500);                
        }
    }
}
