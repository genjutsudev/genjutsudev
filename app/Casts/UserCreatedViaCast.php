<?php

declare(strict_types=1);

namespace App\Casts;

use App\Enums\UserCreatedViaEnum;
use App\Values\UserCreatedViaValue;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class UserCreatedViaCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): UserCreatedViaValue
    {
        return UserCreatedViaValue::make(UserCreatedViaEnum::from($value));
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }
}
