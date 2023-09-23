<?php

namespace App\DTOs\Auth;

use App\Exceptions\ValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class CreateUserDTO extends ValidatedDTO
{
    public string $name;


    public string $email;


    public ?string $password;

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users,email'],
            'password' => ['nullable', 'string', 'min:6', 'max:15'],
        ];
    }

    protected function failedValidation(): void
    {
        throw new ValidationException($this->validator);

    }

    protected function defaults(): array
    {
        return [
        ];
    }

    protected function casts(): array
    {
        return [];
    }
}
