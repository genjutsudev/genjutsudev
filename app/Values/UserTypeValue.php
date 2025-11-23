<?php

declare(strict_types=1);

namespace App\Values;

use App\Enums\User\UserTypeEnum;

final readonly class UserTypeValue
{
    private function __construct(private UserTypeEnum $type)
    {
    }

    public static function make(UserTypeEnum $type): self
    {
        return new self($type);
    }

    public static function regular(): self
    {
        return self::make(UserTypeEnum::REGULAR);
    }

    public static function admin(): self
    {
        return self::make(UserTypeEnum::ADMIN);
    }

    public static function api(): self
    {
        return self::make(UserTypeEnum::API);
    }

    public function getType(): UserTypeEnum
    {
        return $this->type;
    }

    public function isRegular(): bool
    {
        return $this->type->isRegular();
    }

    public function isAdmin(): bool
    {
        return $this->type->isAdmin();
    }

    public function isApi(): bool
    {
        return $this->type->isApi();
    }

    public function equals(UserTypeValue $other): bool
    {
        return $this->type->equals($other->getType());
    }

    public function __toString()
    {
        return $this->type->value;
    }
}
