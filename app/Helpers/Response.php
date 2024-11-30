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

    public static function validationError($validationMessages) 
    {
        return [
            'retcode'   => -1,
            'message'   => $validationMessages,
            'pid'       => Logger::getPID()
        ];
    }
}