<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Helpers\Response;
use App\Http\Requests\CreateSetor;
use App\Http\Requests\UpdateSetor;
use App\Models\Setor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Info(title="API Custom", version="1.0")
 */
class SetorController extends Controller
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
        
            $setores        = Setor::all();
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

    /**
     * @OA\Get(
     *      path="/setores",
     *      operationId="storeSetor",
     *      tags={"Setores"},
     *      summary="Cadastra setor",
     *      description="Cadastra setor",
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso na criação do registro"
     *       ),
     *       @OA\Response(
     *          response=400, 
     *          description="Bad request"
     *       )
     *     )
     *
     *  Cria registro de Setor
     */
    public function store(Request $request) {
        try {
            Logger::openLog("setor-store");
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");

            $setor      = new CreateSetor(); 
            $validated  = Validator::make($request->all(), $setor->rules());

            if (!$validated->passes()) {
                $responseJSON = Response::validationError($validated->errors()->all());                
                return response()->json($responseJSON, 400);
            }

            DB::beginTransaction();
            
            $setor = Setor::create(["nome" => $request->nome]);
            
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

    public function destroy($id): JsonResponse
    {
        try {
            Logger::openLog("setor-destroy-$id");
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");

            DB::beginTransaction();

            $setor = Setor::find($id);
    
            if (!$setor) {
                $msg = "Impossível realizar a exclusão. O recurso solicitado não existe";
                $responseJSON = Response::validationError($msg);
                return response()->json($responseJSON, 404);
            }
        
            $setor->delete();
            DB::commit();

            $responseJSON = Response::destroy();
            Logger::register(LOG_NOTICE, __METHOD__ . "::OK");
            return response()->json($responseJSON);
        } catch (\Exception $e) {
            Logger::register(LOG_ERR, "ERROR: " . $e->getMessage());
            return response()->json([
                "retcode"   => -1, 
                "message"   => "Erro ao excluir dados da farmácia", 
                "code"      => $e->getCode(),
                "pid"       => Logger::getPID()
            ], 500);
        }
    }

    public function update($id, Request $request): JsonResponse 
    {
        try {
            Logger::openLog("setor-update-$id");
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");

            $update     = new UpdateSetor();
            $validated  = Validator::make($request->all(), $update->rules());

            if (!$validated->passes()) {
                $responseJSON = Response::validationError($validated->errors()->all());
                return response()->json($responseJSON, 400);
            }

            DB::beginTransaction();

            $setor = Setor::find($id);

            if (!$setor) {
                $msg = "Impossível realizar a atualização. O recurso solicitado não existe";
                $responseJSON = Response::validationError($msg); 
                return response()->json($responseJSON, 404);
            }

            $setor->fill(["nome" => $request->nome]);

            $setor->save();
            
            DB::commit();

            $responseJSON = Response::update(Setor::find($id));
            Logger::register(LOG_NOTICE, __METHOD__ . "::OK");
            return response()->json($responseJSON);
        } catch (\Exception $e) {
            Logger::register(LOG_ERR, "ERROR: " . $e->getMessage());
            return response()->json([
                "retcode"   => -1, 
                "message"   => "Erro ao alterar dados da farmácia", 
                "code"      => $e->getCode(),
                "pid"       => Logger::getPID()
            ], 500);
        }
    }
}
