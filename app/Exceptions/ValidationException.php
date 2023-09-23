<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Validator  ;
class ValidationException extends Exception
{
public function __construct( Validator $validaitor)
{
    $this->validaitor=$validaitor;
}

    public function render(): JsonResponse
    {

        return response()->json([
            'message'  => 'Unprocessable Entity',
            'errors' => $this->validaitor->errors(),
        ], 422);
    }
}
