<?php

declare(strict_types=1);

namespace App\Enums;

use App\Traits\EnumTrait;

enum UserCreatedViaEnum: string
{
    use EnumTrait;

    case API = 'api';       // REST API, GraphQL и т.д.
    case CLI = 'cli';       // через командную строку (например, админская утилита).
    case WEB = 'web';       // через веб-форму (основной способ для пользователей).
    case MOBILE = 'mobile'; // через мобильное приложение (iOS/Android).
    case IMPORT = 'import'; // массовый импорт (CSV, Excel, миграция из другой системы).
    case SCRIPT = 'script'; // автоматический скрипт или бот (например, для тестовых данных).
    case INVITE = 'invite'; // регистрация по приглашению (ссылке или коду).
    case OAUTH = 'oauth';   // через соцсети (Google, GitHub, Facebook и т. д.).
    case SSO = 'sso';       // через корпоративный Single Sign-On (Okta, Azure AD).
    case ADMIN = 'admin';   // через панель администратора (вручную).

    public function isApi(): bool
    {
        return $this === self::API;
    }

    public function isCli(): bool
    {
        return $this === self::CLI;
    }

    public function isWeb(): bool
    {
        return $this === self::WEB;
    }

    public function isMobile(): bool
    {
        return $this === self::MOBILE;
    }

    public function isImport(): bool
    {
        return $this === self::IMPORT;
    }

    public function isScript(): bool
    {
        return $this === self::SCRIPT;
    }

    public function isInvite(): bool
    {
        return $this === self::INVITE;
    }

    public function isOauth(): bool
    {
        return $this === self::OAUTH;
    }

    public function isSso(): bool
    {
        return $this === self::SSO;
    }

    public function isAdmin(): bool
    {
        return $this === self::ADMIN;
    }
}
