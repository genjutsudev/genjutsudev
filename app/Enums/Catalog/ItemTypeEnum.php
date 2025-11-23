<?php

declare(strict_types=1);

namespace App\Enums\Catalog;

use App\Traits\EnumTrait;

enum ItemTypeEnum: string
{
    use EnumTrait;

    case ANIME = 'anime';
    case MANGA = 'manga';
    case RANOBE = 'ranobe';
}
