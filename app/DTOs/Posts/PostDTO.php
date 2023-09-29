<?php

namespace App\DTOs\Posts;

use App\Exceptions\AppException;
use App\Exceptions\ValidationException;
use App\Models\Option;
use App\Models\Tag;
use Illuminate\Validation\Rule;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class PostDTO extends ValidatedDTO
{
    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string'],
//            'tags' => ['array'],
            'tags' => Rule::forEach(function ($value, $attr) {
                return [
                    Rule::exists(Tag::class, 'id')
                ];
            }),
//            'tags' => [ Rule::forEach(function ($value, $attr) {
//                return [
//                    'required',
//                    Rule::exists(Tag::class, 'id')
//                ];
//            }),

//            ]
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
