<?php

namespace App\DTOs\Posts;

use App\Exceptions\ValidationException;
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
//            'tags' => Rule::forEach(function ($value, $attr) {
//                return [
//                    'required',
//                    Rule::exists(Tag::class, 'id')
//                ];
//            }),

//            'tags' => ['array', Rule::exists(Option::class, 'id')->where(function ($q) use ($attr) {
//                return $q->where('question_id', intval(str()->between($attr, 'answer.', '.option')));
//            })],
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
