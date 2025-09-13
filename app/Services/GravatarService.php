<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Str;

class GravatarService
{
    public static function url(string $email, int $size = 192): string
    {
        return sprintf("https://www.gravatar.com/avatar/%s?" . http_build_query([
            's' => $size,
            'd' => 'robohash',
            'r' => 'g'
        ]), md5(Str::lower($email)));
    }
}
