<?php

declare(strict_types=1);

namespace App\Enums\User;

use App\Traits\EnumTrait;

enum UserGenderEnum: string
{
    use EnumTrait;

    case MALE = 'male';
    case FEMALE = 'female';
    case OTHER = 'other';

    public function isMale(): bool
    {
        return $this === self::MALE;
    }

    public function isFemale(): bool
    {
        return $this === self::FEMALE;
    }

    public function isOther(): bool
    {
        return $this === self::OTHER;
    }
}
