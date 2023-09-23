<?php

namespace App\DTOs\Auth;

use App\Exceptions\ValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class LoginCredentialsDTO extends ValidatedDTO
{
    public string $email;

    public string $password;


    protected function rules(): array
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }

    protected function defaults(): array
    {
        return [

        ];
    }

    protected function failedValidation(): void
    {
        throw new ValidationException($this->validator);

    }

    protected function casts(): array
    {
        return [];
    }



}
