<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class UserAlreadyExistException extends Exception
{
    public function __construct()
    {
        parent::__construct('Пользователь с таким адресом электронной почты уже существует.');  // @todo i18n
    }
}
