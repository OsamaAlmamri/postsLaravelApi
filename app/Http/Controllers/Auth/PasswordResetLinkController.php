<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\EmailVerifyAction;
use App\Actions\Auth\LoginUserAction;
use App\DTOs\App\ErrorDTO;
use App\DTOs\Auth\ForgetPasswordDTO;
use App\DTOs\Auth\LoginCredentialsDTO;
use App\DTOs\Auth\ResetPasswordDTO;
use App\Exceptions\AppException;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResourse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(ForgetPasswordDTO $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        $otp = (new EmailVerifyAction($user))->handle($user);
        return ok(data: $otp);
    }


}
