<?php

namespace App\Actions\Auth;

use App\DTOs\Auth\CreateUserDTO;
use App\Models\User;
use Exception;
use Validator;

//use App\DTOs\Auth\CreateUserDTO;

class CreateUserAction
{

    public function handle(CreateUserDTO $dto): User
    {
        return User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => bcrypt(value: $dto->password),
        ]);
    }


}
