<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class AppException extends Exception
{
    public function render(): JsonResponse
    {
        return err(error: $this->getMessage());
    }
}
