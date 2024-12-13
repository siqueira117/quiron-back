<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Helpers\Response;
use App\Http\Requests\CreateCategoria;
use App\Http\Requests\UpdateCategoria;
use App\Models\Categoria;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Info(title="API Custom", version="1.0")
 */
class CategoriaController extends Controller
{
    /**
     * @OA\Get(
     *      path="/categorias",
     *      operationId="getCategoriasList",
     *      tags={"Categorias"},
     *      summary="Retorna todos os setores cadastrados",
     *      description="Retorna todos os setores cadastrados",
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
        
            $categorias     = Categoria::with("setor")->get();
            $responseJSON   = Response::index($categorias);
    
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
     * @OA\Delete(
     *      path="/categorias/:id",
     *      operationId="destroyCategoria",
     *      tags={"Categorias"},
     *      summary="Exclui um registro de categoria",
     *      description="Exclui um registro de categoria",
     *      @OA\Response(
     *          response=200
     *       ),
     *       @OA\Response(response=400, description="Bad request")
     *     )
     */
    public function destroy($id): JsonResponse
    {
        try {
            Logger::openLog(__CLASS__."-".__FUNCTION__."-$id");
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");

            DB::beginTransaction();

            $setor = Categoria::find($id);
    
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

    /**
     * @OA\Get(
     *      path="/categorias/:id",
     *      operationId="showCategoria",
     *      tags={"Categorias"},
     *      summary="Retorna um registro de categoria",
     *      description="Retorna um registro de categoria",
     *      @OA\Response(
     *          response=200
     *       ),
     *       @OA\Response(response=400, description="Bad request")
     *     )
     */
    public function show($id): JsonResponse 
    {
        try {
            Logger::openLog(__CLASS__."-".__FUNCTION__."-$id");
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");
        
            $categoria = Categoria::with("setor")->find($id);

            if (!$categoria) {
                $msg = "Impossível realizar a atualização. O recurso solicitado não existe";
                $responseJSON = Response::validationError($msg); 
                return response()->json($responseJSON, 404);
            }

            $responseJSON = Response::show($categoria);
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
     *      path="/categorias",
     *      operationId="storeCategoria",
     *      tags={"Categorias"},
     *      summary="Adiciona um registro de categorias",
     *      description="Adiciona um registro de categorias",
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

            $setor      = new CreateCategoria(); 
            $validated  = Validator::make($request->all(), $setor->rules());

            if (!$validated->passes()) {
                $responseJSON = Response::validationError($validated->errors()->all());                
                return response()->json($responseJSON, 400);
            }

            DB::beginTransaction();
            
            $setor = Categoria::create(["nome" => $request->nome, "setor_id" => $request->setor_id]);
            
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

    
    public function update($id, Request $request): JsonResponse 
    {
        try {
            Logger::openLog(__CLASS__."-".__FUNCTION__."-$id");
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");

            $update     = new UpdateCategoria();
            $validated  = Validator::make($request->all(), $update->rules());

            if (!$validated->passes()) {
                $responseJSON = Response::validationError($validated->errors()->all());
                return response()->json($responseJSON, 400);
            }

            DB::beginTransaction();

            $setor = Categoria::find($id);

            if (!$setor) {
                $msg = "Impossível realizar a atualização. O recurso solicitado não existe";
                $responseJSON = Response::validationError($msg); 
                return response()->json($responseJSON, 404);
            }

            $setor->fill(["nome" => $request->nome, "setor_id" => $request->setor_id]);

            $setor->save();
            
            DB::commit();

            $responseJSON = Response::update(Categoria::find($id));
            Logger::register(LOG_NOTICE, __METHOD__ . "::OK");
            return response()->json($responseJSON);
        } catch (\Exception $e) {
            Logger::register(LOG_ERR, "ERROR: " . $e->getMessage());
            return response()->json([
                "retcode"   => -1, 
                "message"   => "Erro ao alterar dados de categoria", 
                "code"      => $e->getCode(),
                "pid"       => Logger::getPID()
            ], 500);
        }
    }
}
