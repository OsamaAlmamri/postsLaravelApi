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
            'password' => ['nullable', 'string', 'min:6', 'max:15'],
            'password_confirmation' => ['required', 'string', 'min:6', 'max:50'],
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
