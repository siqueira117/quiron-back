<?php

namespace App\Http\Controllers;

use App\Models\Farmacia;
use App\Models\Responsavel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        return response()->json(Farmacia::with('responsavel')->get());
    }

    public function show($id) {
        return response()->json(Farmacia::with('responsavel')->find($id));
    }

    public function destroy($id) {

        DB::beginTransaction();

        $farmacia = Farmacia::with('responsavel')->find($id);

        if ($farmacia == null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        Responsavel::destroy($farmacia->responsavel_id);

        $farmacia->delete();
        DB::commit();

        return response()->json(['msg' => 'A registro foi removido com sucesso!'], 200);

    }

    public function update($id, Request $request) {

        $farmacia = new Farmacia();

        $this->validate($request, $farmacia->rules());

        DB::beginTransaction();

        $farmacia = Farmacia::with('responsavel')->find($id);

        if ($farmacia == null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
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
                "nome_visualizacao"     => $request->nome_visualizacao,
                "cnpj"                  => $request->cnpj,
                "cep"                   => $request->cep,
                "logradouro"            => $request->logradouro,
                "complemento"           => $request->complemento,
                "numero"                => $request->numero,
                "bairro"                => $request->bairro,
                "cidade"                => $request->cidade,
                "uf"                    => $request->uf,
            ]
        );



        $responsavel->save();
        $farmacia->save();

        DB::commit();

        return response()->json(Farmacia::with('responsavel')->find($id));
    }

    public function store(Request $request) {

        $this->postProcessFarmaciaStore($request->nome_visualizacao);

        $farmacia = new Farmacia(); 
        $validated = Validator::make($request->all(), $farmacia->rules());
        
        if (!$validated->passes()) {
            return response()
                ->json([
                    'retcode' => -1,
                    'message' => $validated->errors()->all() 
                ], 500);
        }

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
                "responsavel_id"        => $responsavel->id,
            ]
        );

        DB::commit();

        return response()->json($farmacia);
    }

    private function postProcessFarmaciaStore(string $databaseName): array {
        try {
            $tenant = \App\Models\Tenant::create(['id' => $databaseName]);
            $tenant->domains()->create(['domain' => "$databaseName.localhost"]);

            return ["retcode" => 0, "message" => "OK"];
        } catch (\Exception $e) {
            return ["retcode" => -1, "message" => $e->getMessage(), "code" => $e->getCode()];
        }
    }
}
