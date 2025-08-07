<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\UserUser as User;
use App\Services\UserService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

readonly class UserUserObserver
{
    public function __construct(
        private UserService $userService
    )
    {
    }

    /**
     * Handle the User "updating" event.
     */
    public function updating(User $user): void
    {
        $now = Carbon::now();
        $userId = Auth::id();

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
            $user->email_changed_at = $now;
        }

        if ($user->isDirty('password')) {
            $user->password_changed_at = $now;
        }

        foreach (['profilename', 'profilelink', 'email', 'password'] as $field) {
            if ($user->isDirty($field)) {
                $this->userService->createHistoryField($user, $field, $userId);
            }
        }
    }
}
