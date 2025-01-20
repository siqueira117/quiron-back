<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class CurlRequestException extends Exception
{
    public function render(Request $request)
    {       
        return response()->json(["error" => true, "message" => $this->getMessage()]);       
    }
}
