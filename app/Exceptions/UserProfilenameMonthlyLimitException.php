<?php

namespace App\Exceptions;

use Exception;

class UserProfilenameMonthlyLimitException extends Exception
{
    public function __construct(int $limit)
    {
        parent::__construct("Имя профиля можно изменить только {$limit} раз(а) в месяц.");  // @todo i18n
    }
}
