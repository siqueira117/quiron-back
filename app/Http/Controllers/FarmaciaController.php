<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Helpers\Password;
use App\Helpers\Response;
use App\Http\Requests\UpdateFarmacia;
use App\Models\Farmacia;
use App\Models\Responsavel;
use App\Models\Tenant;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class FarmaciaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index() {
        try {
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");
        
            $farmacias = Farmacia::with('responsavel')->get();
            $responseJSON = [
                "retcode"   => 0,
                "message"   => "Registros recuperados com sucesso!",
                "rows"      => $farmacias,
                "pid"       => Logger::getPID()
            ];
    
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

    public function show($id) {
        try {
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");

            $farmacia = Farmacia::with('responsavel')->find($id);
            $responseJSON = [
                "retcode"   => 0,
                "message"   => "Registro recuperado com sucesso!",
                "rows"      => [$farmacia],
                "pid"       => Logger::getPID()
            ];

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

    public function destroy($id): JsonResponse
    {
        try {
            Logger::openLog("farmacia-destroy-$id");
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");

            DB::beginTransaction();

            $farmacia = Farmacia::with('responsavel')->find($id);
    
            if (!$farmacia) {
                $msg = "Impossível realizar a exclusão. O recurso solicitado não existe";
                $responseJSON = Response::validationError($msg);
                return response()->json($responseJSON, 404);
            }
    
            Responsavel::destroy($farmacia->responsavel_id);
    
            $farmacia->delete();
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

    public function update($id, Request $request) 
    {
        try {
            Logger::openLog("farmacia-update-$id");
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");

            $update     = new UpdateFarmacia();
            $validated  = Validator::make($request->all(), $update->rules());

            if (!$validated->passes()) {
                $responseJSON = [
                    'retcode'   => -1,
                    'message'   => $validated->errors()->all(),
                    'pid'       => Logger::getPID()
                ];
                Logger::register(LOG_ERR, __METHOD__ . " - Erro de validação - " . json_encode($responseJSON));

                return response()->json($responseJSON, 400);
            }

            DB::beginTransaction();

            $farmacia = Farmacia::with('responsavel')->find($id);

            if (!$farmacia) {
                $msg = "Impossível realizar a atualização. O recurso solicitado não existe";
                $responseJSON = [
                    "retcode"   => -1,
                    "message"   => $msg,
                    "pid"       => Logger::getPID()
                ];

                Logger::register(LOG_ERR, "ERRO: $msg");
                Logger::register(LOG_NOTICE, "Response: " . json_encode($responseJSON));
                
                return response()->json($responseJSON, 404);
            }

            $responsavel = Responsavel::find($farmacia->responsavel_id);

            $responsavel->fill(
                [
                    "nome"      => $request->responsavel['nome'],
                    "email"     => $request->responsavel['email'],
                    "telefone"  => $request->responsavel['telefone'],
                ]
            );

            $farmacia->fill(
                [
                    "nome"                  => $request->nome,
                    "cnpj"                  => $request->cnpj,
                    "cep"                   => $request->cep,
                    "logradouro"            => $request->logradouro,
                    "complemento"           => $request->complemento,
                    "numero"                => $request->numero,
                    "bairro"                => $request->bairro,
                    "cidade"                => $request->cidade,
                    "uf"                    => $request->uf
                ]
            );

            $responsavel->save();
            $farmacia->save();

            DB::commit();

            $responseJSON = [
                "retcode"   => 0,
                "message"   => "Registro alterado com sucesso!",
                "rows"      => [Farmacia::with('responsavel')->find($id)],
                "pid"       => Logger::getPID()
            ];

            Logger::register(LOG_NOTICE, "Response: " . json_encode($responseJSON));
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

    public function store(Request $request) {
        try {
            Logger::openLog("farmacia-store");
            Logger::register(LOG_NOTICE, __METHOD__ . "::START");

            $farmacia   = new Farmacia(); 
            $validated  = Validator::make($request->all(), $farmacia->rules());

            if (!$validated->passes()) {
                $responseJSON = [
                    'retcode'   => -1,
                    'message'   => $validated->errors()->all(),
                    'pid'       => Logger::getPID()
                ];
                Logger::register(LOG_ERR, __METHOD__ . " - Erro de validação - " . json_encode($responseJSON));
                
                return response()->json($responseJSON, 400);
            }

            $dadosReceita   = $this->consultaDadosReceita($request->cnpj);
            $farmaciaCriada = $this->storeFarmaciaEResponsavel($request, $dadosReceita);
            $this->postProcessFarmaciaStore($request);

            $responseJSON = [
                "retcode"   => 0,
                "message"   => "Registro criado com sucesso!",
                "rows"      => [$farmaciaCriada],
                "pid"       => Logger::getPID()
            ];
            Logger::register(LOG_NOTICE, "Registro criado com sucesso - Response: " . json_encode($responseJSON));
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

    private function consultaDadosReceita(string $cnpj): string 
    {
        Logger::register(LOG_NOTICE, __METHOD__ . "::START");

        $response   = Http::get("https://open.cnpja.com/office/$cnpj");
        
        if ($response->failed()) {
            Logger::register(LOG_ERR, "Retorno da API de consulta: " . json_encode($response->json()));
            
            $responseJSON = [
                'retcode' => -1,
                'message' => "Erro ao consultar CNPJ na Receita Federal" 
            
            ];
            Logger::register(LOG_ERR, __METHOD__ . " - Erro na consulta - " . json_encode($responseJSON));
            return response()->json($responseJSON, 500);
        }

        Logger::register(LOG_NOTICE, "Dados da receita gravados com sucesso!");
        Logger::register(LOG_NOTICE, __METHOD__ . "::OK");
        return json_encode($response->json());
    }

    private function storeFarmaciaEResponsavel(Request $request, string $dadosReceita): Farmacia 
    {
        DB::beginTransaction();

        $responsavel = Responsavel::create(
            [
                "nome"      => $request->responsavel['nome'],
                "email"     => $request->responsavel['email'],
                "telefone"  => $request->responsavel['telefone'],
            ]
        );

        $farmacia = Farmacia::create(
            [
                "nome"                  => $request->nome,
                "nome_visualizacao"     => $request->nome_visualizacao,
                "cnpj"                  => $request->cnpj,
                "cep"                   => $request->cep,
                "logradouro"            => $request->logradouro,
                "complemento"           => $request->complemento,
                "numero"                => $request->numero,
                "bairro"                => $request->bairro,
                "cidade"                => $request->cidade,
                "uf"                    => $request->uf,
                "dados_receita"         => $dadosReceita,
                "responsavel_id"        => $responsavel->id,
            ]
        );

        DB::commit();
        return $farmacia;
    }

    private function postProcessFarmaciaStore(Request $request): void 
    {
        Logger::register(LOG_NOTICE, __FUNCTION__ . "::START");
        
        $tenant = $this->createCustomDB($request->nome_visualizacao);
        $this->createUserForResponsavel($tenant, $request->responsavel);
    
        Logger::register(LOG_NOTICE, __FUNCTION__ . "::END");
    }

    private function createCustomDB(string $databaseName): Tenant 
    {
        Logger::register(LOG_NOTICE, __FUNCTION__ . "::START");

        $tenant = Tenant::create(['id' => $databaseName]);
        $tenant->domains()->create(['domain' => "$databaseName.localhost"]);

        Logger::register(LOG_NOTICE, "Banco '$databaseName' criado com sucesso!");
        Logger::register(LOG_NOTICE, __FUNCTION__ . "::END");

        return $tenant;
    }

    private function createUserForResponsavel(Tenant $tenant,array $responsavel) 
    {
        Logger::register(LOG_NOTICE, __METHOD__ . "::START");

        $tenant->run(function () use ($responsavel) {
            DB::beginTransaction();

            $usuario = Usuario::create([
                'nome' => $responsavel["nome"],
                'email' => $responsavel["email"],
                'senha' => Password::generate($responsavel["senha"])
            ]);

            DB::commit();
            Logger::register(LOG_NOTICE, "Usuário criado com sucesso - " . json_encode($usuario));
        });

        Logger::register(LOG_NOTICE, __METHOD__ . "::OK");
    }

}
