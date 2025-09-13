<?php

declare(strict_types=1);

namespace App\Services\Contracts;

interface HasherInterface
{
    public function hash(string $value, array $options = []): string;
    public function verify(string $value, string $hash): bool;
}
