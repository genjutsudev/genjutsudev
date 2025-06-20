<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\Hash;

trait HasherTrait
{
    protected function hash(string $value, array $options = []): string
    {
        return Hash::make($value, $options);
    }

    protected function verify(string $value, string $hash): bool
    {
        return Hash::check($value, $hash);
    }
}
