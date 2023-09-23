<?php

namespace App\DTOs\Auth;

use App\Exceptions\ValidationException;
use WendellAdriel\ValidatedDTO\ValidatedDTO;
use Illuminate\Validation\Rules;
class ResetPasswordDTO extends ValidatedDTO
{
    public string $email;


    protected function rules(): array
    {
        return [
            'email' => 'required|exists:users,email',
            'otp' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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
