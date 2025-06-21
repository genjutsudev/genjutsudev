<?php

declare(strict_types=1);

namespace App\Traits;

trait SessionFlashMessagesTrait
{
    private static function message(string $level, string $message): void
    {
        $messages = session()->get('messages', []);
        $messages[] = ['level' => $level, 'message' => $message];
        session()->flash('messages', $messages);
    }

    public static function hasMessages(): bool
    {
        return session()->has('messages');
    }

    public static function getMessages(): array
    {
        return session()->get('messages', []);
    }

    protected static function success(string $message): void
    {
        self::message('success', $message);
    }

    protected static function info(string $message): void
    {
        self::message('info', $message);
    }

    protected static function warning(string $message): void
    {
        self::message('warning', $message);
    }

    protected static function danger(string $message): void
    {
        self::message('danger', $message);
    }
}
