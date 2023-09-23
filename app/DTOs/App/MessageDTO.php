<?php

namespace App\DTOs\App;

use App\Casts\TranslatedDTOCast;
use WendellAdriel\ValidatedDTO\SimpleDTO;

class MessageDTO extends SimpleDTO
{

    public string $title;

    public ?string $desc;

    public ?string $type;



    protected function defaults(): array
    {
        return [
            'desc' => null,
            'type' => 'success',
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
