<?php

declare(strict_types=1);

namespace App\Enums\User;

use App\Traits\EnumTrait;

enum UserTypeEnum: string
{
    use EnumTrait;

    case REGULAR = 'regular';
    case ADMIN = 'admin';
    case API = 'api';

    public function isRegular(): bool
    {
        return $this === self::REGULAR;
    }

    public function isAdmin(): bool
    {
        return $this === self::ADMIN;
    }

    public function isApi(): bool
    {
        return $this === self::API;
    }
}
