<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class UserProfilelinkMonthlyLimitException extends Exception
{
    public function __construct(int $limit)
    {
        parent::__construct("Ссылку профиля можно изменить только {$limit} раз(а) в месяц."); // @todo i18n
    }
}
