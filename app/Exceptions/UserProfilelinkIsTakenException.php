<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class UserProfilelinkIsTakenException extends Exception
{
    public function __construct()
    {
        parent::__construct("Ссылка профиля занята.");  // @todo i18n
    }
}
