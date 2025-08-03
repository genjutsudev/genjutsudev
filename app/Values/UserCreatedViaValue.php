<?php

namespace App\Values;

use App\Enums\UserCreatedViaEnum;

final readonly class UserCreatedViaValue
{
    private function __construct(private UserCreatedViaEnum $via)
    {
    }

    public static function make(UserCreatedViaEnum $via): self
    {
        return new self($via);
    }

    public static function api(): self
    {
        return self::make(UserCreatedViaEnum::API);
    }

    public static function cli(): self
    {
        return self::make(UserCreatedViaEnum::CLI);
    }

    public static function web(): self
    {
        return self::make(UserCreatedViaEnum::WEB);
    }

    public static function mobile(): self
    {
        return self::make(UserCreatedViaEnum::MOBILE);
    }

    public static function import(): self
    {
        return self::make(UserCreatedViaEnum::IMPORT);
    }

    public static function script(): self
    {
        return self::make(UserCreatedViaEnum::SCRIPT);
    }

    public static function invite(): self
    {
        return self::make(UserCreatedViaEnum::INVITE);
    }

    public static function oauth(): self
    {
        return self::make(UserCreatedViaEnum::OAUTH);
    }

    public static function sso(): self
    {
        return self::make(UserCreatedViaEnum::SSO);
    }

    public static function admin(): self
    {
        return self::make(UserCreatedViaEnum::ADMIN);
    }

    public function isApi(): bool
    {
        return $this->via->isApi();
    }

    public function isCli(): bool
    {
        return $this->via->isCli();
    }

    public function isWeb(): bool
    {
        return $this->via->isWeb();
    }

    public function isMobile(): bool
    {
        return $this->via->isMobile();
    }

    public function isImport(): bool
    {
        return $this->via->isImport();
    }

    public function isScript(): bool
    {
        return $this->via->isScript();
    }

    public function isInvite(): bool
    {
        return $this->via->isInvite();
    }

    public function isOauth(): bool
    {
        return $this->isOauth();
    }

    public function isSso(): bool
    {
        return $this->via->isSso();
    }

    public function isAdmin(): bool
    {
        return $this->via->isAdmin();
    }

    public function getVia(): UserCreatedViaEnum
    {
        return $this->via;
    }

    public function equals(UserCreatedViaValue $other): bool
    {
        return $this->via->equals($other->getVia());
    }

    public function __toString()
    {
        return $this->via->value;
    }
}
