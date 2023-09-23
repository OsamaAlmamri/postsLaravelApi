<?php

use App\DTOs\App\ErrorDTO;
use App\DTOs\App\MessageDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\MessageBag;
use Symfony\Component\HttpFoundation\Response;

if (!function_exists('ok')) {
    function ok(
        $data = null,
        string|MessageDTO|null $message = null,
        int $status = Response::HTTP_OK
    ): JsonResponse
    {
        $response = [];

        if ($data) {
            $response['data'] = $data;
        }

        if ($message) {
            if (is_string($message) && Lang::has(key: $message)) {
                $message = trans(key: $message);
            }

            $response['message'] = $message;
        }

        return response()->json($response, $status);
    }
}

if (!function_exists('err')) {
    function err(
        $data = null,
        string|ErrorDTO|null $error = null,
        int $status = Response::HTTP_BAD_REQUEST,
        ?array $debug = null,
        ?MessageBag $errors = null
    ): JsonResponse
    {
        $response = [];

        if ($data) {
            $response['data'] = $data;
        }

        if ($error) {
            if (is_string($error) && Lang::has(key: $error)) {
                $error = trans(key: $error);
            }

            $response['error'] = $error;
        }

        if ($debug) {
            $response['debug'] = $debug;
        }

        return response()->json($response, $status);
    }
}
