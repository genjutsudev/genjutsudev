<?php

namespace App\Http\Controllers;

use App\Traits\SessionFlashMessagesTrait;

abstract class Controller
{
    use SessionFlashMessagesTrait;
}
