<?php

namespace App\Casts;

use Illuminate\Support\Facades\Lang;
use WendellAdriel\ValidatedDTO\Casting\Castable;

class TranslatedDTOCast implements Castable
{
    public function cast(string $property, mixed $value): mixed
    {
        return Lang::has(key: $value)
            ? (Lang::has($value) ? trans(key: $value) : $value)
            : $value;
    }
}
