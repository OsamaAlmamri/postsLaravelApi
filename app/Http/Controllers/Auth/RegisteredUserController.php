<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\CreateUserAction;
use App\Actions\Auth\LoginUserAction;
use App\DTOs\App\ErrorDTO;
use App\DTOs\Auth\CreateUserDTO;
use App\DTOs\Auth\LoginCredentialsDTO;
use App\Exceptions\AppException;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResourse;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    /**
     * @OA\POST (
     *      path="/api/register",
     *      operationId="register",
     *      tags={"auth"},
     *      summary=" register new account",
     *      description=" ",
     *        @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
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

    public function store(CreateUserDTO $request): JsonResponse
    {
        try {
            $user = (new CreateUserAction())->handle(
                dto: CreateUserDTO::fromRequest(request: \request())
            );
        } catch (AppException $e) {
            return err(error: ErrorDTO::fromArray(array: [
                'title' => $e->getMessage(),
                'desc' => 'Something went wrong, please try again later.',
            ]));
        }
//        $token = $user->createToken('Device')->plainTextToken;
        return ok(data: new UserResourse($user));
    }


}
