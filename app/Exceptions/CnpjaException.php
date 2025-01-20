<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class CnpjaException extends Exception
{
    public function render(Request $request)
    {       
        return response()->json(["retcode" => -1, "message" => $this->getMessage()], $this->getCode());       
    }
}
