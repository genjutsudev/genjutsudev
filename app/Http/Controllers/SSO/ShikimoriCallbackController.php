<?php

declare(strict_types=1);

namespace App\Http\Controllers\SSO;

final class ShikimoriCallbackController extends AbstractCallbackController
{
    protected function driver(): string
    {
        return 'shikimori';
    }
}
