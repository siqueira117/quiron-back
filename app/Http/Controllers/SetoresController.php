<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Helpers\Response;
use App\Models\Setores;
use Illuminate\Http\Request;

/**
 * @OA\Info(title="API Custom", version="1.0")
 */
class SetoresController extends Controller
{
    /**
     * @OA\Get(
     *      path="/setores",
     *      operationId="getSetoresList",
     *      tags={"Setores"},
     *      summary="Retorna todos os setores cadastrados",
     *      description="Retorna todos os setores cadastrados",
     *      @OA\Response(
     *          response=200,
     *          description="{ 'retcode': 0, 'message': 'Registros recuperados com sucesso!', 'rows': [{ 'id': 1, 'nome': 'Medicamentos', 'created_at': '2024-12-02T21:34:39.000000Z', 'updated_at': '2024-12-02T21:34:39.000000Z'}] }"
     *       ),
     *       @OA\Response(response=400, description="Bad request")
     *     )
     *
     * Returns list of projects
     */
    public function index() {
        try {
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");
        
            $setores        = Setores::all();
            $responseJSON   = Response::index($setores);
    
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
