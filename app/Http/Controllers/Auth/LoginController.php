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
