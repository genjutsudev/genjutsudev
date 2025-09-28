<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class UserEmailTakenException extends Exception
{
    public function __construct()
    {
        parent::__construct('Эл. почта занята.'); // @todo i18n
    }
}
