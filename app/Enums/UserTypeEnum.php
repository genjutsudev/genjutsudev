<?php

declare(strict_types=1);

namespace App\Enums;

enum UserTypeEnum: string
{
    case REGULAR = 'regular';
    case ADMIN = 'admin';
    case API = 'api';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

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

    public function equals(self $other): bool
    {
        return $this === $other;
    }
}
