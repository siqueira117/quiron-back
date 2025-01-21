<?php

namespace App\Http\Controllers;

use App\Models\Entregador;
use Illuminate\Http\Request;
use App\Helpers\{Logger, Response};
use App\Http\Requests\CreateEntregador;
use App\Http\Requests\UpdateEntregador;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class EntregadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            Logger::openLog("entregador-index");
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");

            $entregadores   = Entregador::all();
            $responseJSON   = Response::index($entregadores);

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            Logger::openLog("entregador-store");
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");

            $entregador      = new CreateEntregador();
            $validated  = Validator::make($request->all(), $entregador->rules());

            if (!$validated->passes()) {
                $responseJSON = Response::validationError($validated->errors()->all());
                return response()->json($responseJSON, 400);
            }

            DB::beginTransaction();

            $entregador = Entregador::create(["nome" => $request->nome]);

            DB::commit();

            $responseJSON = Response::store($entregador);
            Logger::register(LOG_NOTICE, __METHOD__ . "::END");
            return response()->json($responseJSON, 200);
        } catch (\Exception $e) {
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        try {
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");

            $entregador = Entregador::find($id);

            if (!$entregador) {
                $msg = "Impossível realizar a atualização. O recurso solicitado não existe";
                $responseJSON = Response::validationError($msg);
                return response()->json($responseJSON, 404);
            }

            $responseJSON = Response::show($entregador);
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
     * Update the specified resource in storage.
     */
    public function update($id, Request $request): JsonResponse
    {
        try {
            Logger::openLog("entregador-update-$id");
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");

            $update     = new UpdateEntregador();
            $validated  = Validator::make($request->all(), $update->rules());

            if (!$validated->passes()) {
                $responseJSON = Response::validationError($validated->errors()->all());
                return response()->json($responseJSON, 400);
            }

            DB::beginTransaction();

            $entregador = Entregador::find($id);

            if (!$entregador) {
                $msg = "Impossível realizar a atualização. O recurso solicitado não existe";
                $responseJSON = Response::validationError($msg);
                return response()->json($responseJSON, 404);
            }

            $entregador->fill([
                "nome" => $request->nome,
                "tel_celular" => $request->tel_celular
            ]);

            $entregador->save();

            DB::commit();

            $responseJSON = Response::update(Entregador::find($id));
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        try {
            Logger::openLog("entregador-destroy-$id");
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");

            DB::beginTransaction();

            $entregador = Entregador::find($id);

            if (!$entregador) {
                $msg = "Impossível realizar a exclusão. O recurso solicitado não existe";
                $responseJSON = Response::validationError($msg);
                return response()->json($responseJSON, 404);
            }

            $entregador->delete();
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
}
