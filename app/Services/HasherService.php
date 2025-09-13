<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Contracts\HasherInterface;
use Illuminate\Support\Facades\Hash;

class HasherService implements HasherInterface
{
    public function hash(string $value, array $options = []): string
    {
        return match ($algo = $options['driver'] ?? null) {
            'md5', 'sha256' => \hash($algo, $value),
            default => Hash::make($value, $options),
        };
    }

    public function verify(string $value, string $hash): bool
    {
        return Hash::check($value, $hash);
    }
}
