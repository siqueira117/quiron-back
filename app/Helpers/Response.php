<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;

class Response {
    public static function index(Collection $dados): array 
    {
        return [
            "retcode"   => 0,
            "message"   => "Registros recuperados com sucesso!",
            "rows"      => $dados,
            "pid"       => Logger::getPID()
        ];
    }

    public static function validationError($validationMessages = "Erro de validação"): array 
    {
        $responseJSON = [
            'retcode'   => -1,
            'message'   => $validationMessages,
            'pid'       => Logger::getPID()
        ];

        Logger::register(LOG_ERR, __METHOD__ . " - Erro de validação - " . json_encode($responseJSON));
        return $responseJSON;
    }

    public static function store($registroCriado): array 
    {
        $responseJSON = [
            "retcode"   => 0,
            "message"   => "Registro criado com sucesso!",
            "rows"      => [$registroCriado],
            "pid"       => Logger::getPID()
        ];

        Logger::register(LOG_NOTICE, "Registro criado com sucesso - Response: " . json_encode($responseJSON));
        return $responseJSON;
    }

    public static function destroy(string $msg = "Registro removido com sucesso!"): array 
    {
        $responseJSON = [
            "retcode"   => 0,
            "message"   => $msg,
            "pid"       => Logger::getPID()
        ];

        Logger::register(LOG_NOTICE, "Registro removido - Response: " . json_encode($responseJSON));
        return $responseJSON;
    }

    public static function update($registros): array 
    {
        $responseJSON = [
            "retcode"   => 0,
            "message"   => "Registro alterado com sucesso!",
            "rows"      => [$registros],
            "pid"       => Logger::getPID()
        ];

        Logger::register(LOG_NOTICE, "Registros alterados - Response: " . json_encode($responseJSON));
        return $responseJSON;
    }

    public static function show($registro): array 
    {
        $responseJSON = [
            "retcode"   => 0,
            "message"   => "Registros recuperados com sucesso!",
            "rows"      => $registro,
            "pid"       => Logger::getPID()
        ];

        Logger::register(LOG_NOTICE, "Registros consultado - Response: " . json_encode($responseJSON));
        return $responseJSON;
    }

    public static function registrosNaoEncontrados(): array
    {
        $responseJSON = [
            "retcode"   => 0,
            "message"   => "Nenhum registro foi encontrado!",
            "pid"       => Logger::getPID()
        ];

        Logger::register(LOG_NOTICE, "Registros consultado - Response: " . json_encode($responseJSON));
        return $responseJSON;
    }
}