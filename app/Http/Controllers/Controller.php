<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Traits\SessionFlashMessages;

abstract class Controller
{
    use SessionFlashMessages;
}
