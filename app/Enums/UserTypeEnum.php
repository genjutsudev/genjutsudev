<?php

declare(strict_types=1);

namespace App\Enums;

enum UserTypeEnum: string
{
    case REGULAR = 'regular';
    case ADMIN = 'admin';
    case API = 'api';
}
