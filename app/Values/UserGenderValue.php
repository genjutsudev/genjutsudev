<?php

declare(strict_types=1);

namespace App\Values;

use App\Enums\UserGenderEnum;

final readonly class UserGenderValue
{
    private function __construct(private UserGenderEnum $gender)
    {
    }

    public static function make(UserGenderEnum $gender): self
    {
        return new self($gender);
    }

    public static function male(): self
    {
        return self::make(UserGenderEnum::MALE);
    }

    public function getGender(): UserGenderEnum
    {
        return $this->gender;
    }

    public function isMale(): bool
    {
        return $this->gender->isMale();
    }

    public function isFemale(): bool
    {
        return $this->gender->isFemale();
    }

    public function isOther(): bool
    {
        return $this->gender->isOther();
    }

    public function equals(UserGenderValue $other): bool
    {
        return $this->gender->equals($other->getGender());
    }

    public function __toString()
    {
        return $this->gender->value;
    }
}
