<?php

namespace App\Actions\Auth;

use App\DTOs\Auth\LoginCredentialsDTO;
use App\Exceptions\AppException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Throwable;

class LoginUserAction
{
    /**
     * @throws Throwable
     */
    public function handle(LoginCredentialsDTO $dto): User
    {
        $user = User::where('email',$dto->email)->first();

        if (! $user || ! Hash::check($dto->password, $user->password)) {
            throw new AppException(__('codes.invalid_credentials'));
        }

        return $user;
    }
}
