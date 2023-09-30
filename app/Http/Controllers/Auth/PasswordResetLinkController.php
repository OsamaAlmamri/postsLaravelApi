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

    /**
     * @OA\POST (
     *      path="/api/forgot-password",
     *      operationId="password_reset_otp_send",
     *      tags={"auth"},
     *      summary="password  reset otp send",
     *      description=" ",
     *        @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ForgetPasswordOtpSendRequest")
     *      ),
     *     @OA\Response(
     *         response=400,
     *         description="Error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="error",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Error")
     *             )
     *         )
     *     ),
     *  @OA\Response(
     *          response=422,
     *              description="Error in Requried Inputs",
     *        @OA\JsonContent(
     *          type="object",
     *       * @OA\Property(
     *          property="message",
     *          type="string",
     *          description="Error Message",
     *          example="Unprocessable Entity"
     *      ),
     *        @OA\Property(
     *          property="errors",
     *          type="Object",
     *          description="Errors",
     *
     *          example= "{'email': ['الإيميل مطلوب'   ]}"
     *                  )
     *              )
     *          ),
     *
     *       @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object"
     *         )
     *     )
     *     )
     */
    public function store(ForgetPasswordDTO $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        $otp = (new EmailVerifyAction($user))->handle($user);
        return ok(data: $otp);
    }


}
