<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Helpers\Response;
use App\Http\Requests\CreateCliente;
use App\Models\Cliente;
use App\Models\ClienteEndereco;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    /**
     * @OA\Get(
     *      path="/clientes",
     *      operationId="getClientesList",
     *      tags={"Clientes"},
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
        
            $clientes       = Cliente::with("enderecos")->get();
            $responseJSON   = Response::index($clientes);
    
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
     *      path="/clientes",
     *      operationId="storeClientes",
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

            $cliente    = new CreateCliente(); 
            $validated  = Validator::make($request->all(), $cliente->rules());

            if (!$validated->passes()) {
                $responseJSON = Response::validationError($validated->errors()->all());                
                return response()->json($responseJSON, 400);
            }

            DB::beginTransaction();
            
            $cliente = Cliente::create([
                "nome"          => $request->nome, 
                "tel_celular"   => $request->tel_celular,
                "email"         => $request->email ?? null
            ]);

            if ($request->endereco) {
                $clienteEndereco = ClienteEndereco::create([
                    "cep"           => $request->endereco["cep"],
                    "logradouro"    => $request->endereco["logradouro"],
                    "numero"        => $request->endereco["numero"],
                    "bairro"        => $request->endereco["bairro"],
                    "complemento"   => $request->endereco["complemento"] ?? "",
                    "cidade"        => $request->endereco["cidade"],
                    "uf"            => $request->endereco["uf"],
                    "cliente_id"    => $cliente->id
                ]);
            }
            
            $cliente = Cliente::with("enderecos")->find($cliente->id);

            DB::commit();
            
            $responseJSON = Response::store($cliente);
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
