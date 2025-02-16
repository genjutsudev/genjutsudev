<?php

declare(strict_types=1);

namespace App\Traits;

trait SessionFlashMessages
{
    /**
     * Add a flash message to the session.
     *
     * @param string $level The level of the message (e.g., 'success', 'info', 'warning', 'danger').
     * @param string $message The message content.
     * @return void
     */
    private static function message(string $level, string $message): void
    {
        $messages = session()->get('messages', []);

        // Add new message to the existing ones
        $messages[] = ['level' => $level, 'message' => $message];

        // Store the updated messages array in the session
        session()->flash('messages', $messages);
    }

    /**
     * Check if there are any flash messages in the session.
     *
     * @return bool
     */
    public static function hasMessages(): bool
    {
        return session()->has('messages');
    }

    /**
     * Get all flash messages from the session.
     *
     * @return array
     */
    public static function getMessages(): array
    {
        return session()->get('messages', []);
    }

    // Shortcut methods for different message levels
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
