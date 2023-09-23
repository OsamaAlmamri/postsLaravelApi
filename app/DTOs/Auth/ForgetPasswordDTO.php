<?php

namespace App\DTOs\Auth;

use App\Exceptions\ValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class ForgetPasswordDTO extends ValidatedDTO
{
    public string $email;


    protected function rules(): array
    {
        return [
            'email' => 'required|exists:users,email',
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
