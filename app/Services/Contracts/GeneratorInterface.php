<?php

declare(strict_types=1);

namespace App\Services\Contracts;

interface GeneratorInterface
{
    public function generate(): string;
}
