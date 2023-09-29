<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Validator  ;
class ValidationException extends Exception
{
    private Validator $validator;
public function __construct( Validator $validator)
{
    $this->validator=$validator;
}

    public function render(): JsonResponse
    {

        return response()->json([
            'message'  => 'Unprocessable Entity',
            'errors' => $this->validator->errors(),
        ], 422);
    }
}
