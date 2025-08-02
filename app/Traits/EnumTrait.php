<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Collection;

trait EnumTrait
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function options(): array
    {
        return array_combine(self::values(), self::values());
    }

    public static function collect(): Collection
    {
        return collect(self::cases());
    }

    public static function collectOptions(): Collection
    {
        return collect(self::options());
    }

    public function equals(self $other): bool
    {
        return $this === $other;
    }

    public static function isValid($value): bool
    {
        return in_array($value, self::values(), true);
    }

    public static function toArray(): array
    {
        return array_combine(self::names(), self::values());
    }
}
