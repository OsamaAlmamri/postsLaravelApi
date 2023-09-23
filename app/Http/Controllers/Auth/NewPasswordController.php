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
