<?php

declare(strict_types=1);

namespace App\Enums\Catalog;

use App\Traits\EnumTrait;

enum ItemStatusEnum: string
{
    use EnumTrait;

    case ANONS = 'anons';               // Анонсировано
    case ONGOING = 'ongoing';           // Сейчас выходит/издаётся
    case RELEASED = 'released';         // Вышедшее/Издано
    case PAUSED = 'paused';             // Приостановлено
    case DISCONNECTED = 'disconnected'; // Прекращено
}
