<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\App\ErrorDTO;
use App\DTOs\Auth\ResetPasswordDTO;
use App\Exceptions\AppException;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResourse;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\JsonResponse;


class NewPasswordController extends Controller
{
    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


    /**
     * @OA\POST (
     *      path="/api/reset-password",
     *      operationId="password_reset_otp_verify",
     *      tags={"auth"},
     *      summary="  otp verify",
     *      description=" ",
     *        @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/OtpVerifyRequest")
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
     *   *   @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                property="data",
     *                 oneOf={
     *                 @OA\Schema(ref="#/components/schemas/User")
     *
     *             },
     *             )
     *         )
     *     )
     *     )
     */
    public function store(ResetPasswordDTO $request): JsonResponse
    {
        try {
            $user = User::where('email', $request->email)->first();
            $otp = Otp::where('otp', $request->otp)
                ->where('email', $request->email)
                ->first();
            if (empty($otp)) {
                return err(error: ErrorDTO::fromArray(array: [
                    'title' => 'Error In Otp ',
                    'desc' => 'Otp Is Wrong',
                ]));
            }
            $otp->delete();
            $user->password= bcrypt(value: $request->password);
            $user->save();
        } catch (AppException $e) {
            return err(error: ErrorDTO::fromArray(array: [
                'title' => $e->getMessage(),
                'desc' => 'Something went wrong, please try again later.',
            ]));
        }
        return ok(data: new UserResourse($user));
    }
}
