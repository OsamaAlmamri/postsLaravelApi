<?php

namespace App\DTOs\App;

use App\Casts\TranslatedDTOCast;
use Illuminate\Support\MessageBag;
use WendellAdriel\ValidatedDTO\SimpleDTO;

class ErrorDTO extends SimpleDTO
{

    public string $title;

    public ?string $desc;
    public ?MessageBag $errors;

    public ?string $type;



    protected function defaults(): array
    {
        return [
            'desc' => null,
            'type' => 'error',
            'errors' => null,

        ];
    }

    protected function casts(): array
    {
        return [
            'title' => new TranslatedDTOCast(),
            'desc' => new TranslatedDTOCast(),
        ];
    }
}
