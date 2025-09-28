<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class ProtectedAttributeException extends Exception
{
    public function __construct(string $attributeName)
    {
        parent::__construct("Значение атрибута \"$attributeName\" защищено от изменений."); // @todo i18n
    }
}
