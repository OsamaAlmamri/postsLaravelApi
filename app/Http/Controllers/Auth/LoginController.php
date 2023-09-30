<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\EmailVerifyAction;
use App\Actions\Auth\LoginUserAction;
use App\DTOs\App\ErrorDTO;
use App\DTOs\Auth\LoginCredentialsDTO;
use App\Exceptions\AppException;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResourse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    /**
     * @OA\POST (
     *      path="/api/login",
     *      operationId="login",
     *      tags={"auth"},
     *      summary="login to the account",
     *      description=" ",
     *        @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
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
     *          *  @OA\Response(
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
    public function login(LoginCredentialsDTO $request): JsonResponse
    {
        try {
            $user = (new LoginUserAction())->handle(
                dto: LoginCredentialsDTO::fromRequest(request: request())
            );
        } catch (AppException $e) {
            return err(error: ErrorDTO::fromArray(array: [
                'title' => $e->getMessage(),
                'desc' => 'Something went wrong, please try again later.',
            ]));
        }
        return ok(data: new UserResourse($user));
    }

    /**
     * @OA\POST (
     *      path="/api/logout",
     *      operationId="logout",
     *      tags={"auth"},
     *      summary="logout from the account",
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
     *       @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *    example= "{data:logout}"
     *         )
     *     )
     *     )
     */
    public function destroy(Request $request): JsonResponse
    {
        try {
//           \auth()->logout();

            DB::table('personal_access_tokens')->where('tokenable_id', \auth()->id())
                ->delete();
        } catch (AppException $e) {
            return err(error: ErrorDTO::fromArray(array: [
                'title' => $e->getMessage(),
                'desc' => 'Something went wrong, please try again later.',
            ]));
        }
        return ok(data: "logout");
    }


}
