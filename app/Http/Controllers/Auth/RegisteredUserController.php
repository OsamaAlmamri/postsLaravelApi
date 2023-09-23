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
