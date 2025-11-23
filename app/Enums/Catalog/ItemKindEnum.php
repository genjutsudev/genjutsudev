<?php

declare(strict_types=1);

namespace App\Enums\Catalog;

use App\Traits\EnumTrait;

enum ItemKindEnum: string
{
    use EnumTrait;

    case TV = 'tv';                     // TV Сериал
    case MOVIE = 'movie';               // Фильм
    case OVA = 'ova';                   // OVA
    case ONA = 'ona';                   // ONA
    case SPECIAL = 'special';           // Спецвыпуск
    case TV_SPECIAL = 'tv_special';     // TV Спецвыпуск
    case MUSIC = 'music';               // Клип
    case PV = 'pv';                     // Проморолик
    case CM = 'cm';                     // Реклама
    case MANGA = 'manga';               // Манга
    case MANHWA = 'manhwa';             // Манхва
    case MANHUA = 'manhua';             // Маньхуа
    case NOVEL = 'novel';               // Ваншот, Новелла
    case LIGHT_NOVEL = 'light_novel';   // -, Ранобэ
    case ONE_SHOT = 'one_shot';         // -
    case DOUJIN = 'doujin';             // Додзинси
}
