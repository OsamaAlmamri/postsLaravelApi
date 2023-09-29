<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use TypeError;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use App\Exceptions\Auth\UserNotActiveException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e): Response|JsonResponse
    {
        if ($request->ajax() || $request->wantsJson()) {
            $debug = app()->hasDebugModeEnabled() ? [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTrace(),
            ] : null;

            if ($e instanceof AuthenticationException) {
                return err(error: 'codes.unauthenticated', status: 401, debug: $debug);
            }


            if ($e instanceof AuthorizationException || $e instanceof AccessDeniedHttpException) {
                return err(error: 'codes.forbidden', status: 403, debug: $debug);
            }

            if ($e instanceof NotFoundHttpException) {
                return err(error: 'codes.not_found', status: 404, debug: $debug);
            }

            if ($e instanceof ModelNotFoundException) {
                return err(error: 'codes.resource_not_found', status: 404, debug: $debug);
            }

            if ($e instanceof QueryException) {
                return err(error: 'codes.bad_request', status: 400, debug: $debug);
            }

            if ($e instanceof MethodNotAllowedHttpException) {
                return err(error: 'codes.bad_request', status: 400, debug: $debug);
            }

            if ($e instanceof TypeError) {
                return err(error: 'codes.internal_server_error', status: 400, debug: $debug);
            }

            if ($e instanceof Exception && $e->getCode() === 500) {
                return err(error: 'codes.internal_server_error', status: 500, debug: $debug);
            }
        }

        return parent::render(request: $request, e: $e);
    }
}
