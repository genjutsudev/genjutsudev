<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Contracts\GeneratorInterface;
use Illuminate\Support\Str;

readonly class ApiKeyGeneratorService implements GeneratorInterface
{
    public function __construct(
        private HasherService $hasherService
    )
    {
    }

    public function generate(): string
    {
        return $this->hasherService->hash(Str::random(), ['driver' => 'sha256']);
    }
}
