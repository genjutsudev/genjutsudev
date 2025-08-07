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
        if ($user->isDirty($field = 'profilename')) {
            $this->userService->createHistoryField($user, $field, Auth::id());
        }

        if ($user->isDirty($field = 'profilelink')) {
            $this->userService->createHistoryField($user, $field, Auth::id());
        }

        if ($user->isDirty($field = 'email')) {
            $user->email_verified_at = null;
            $user->email_changed_at = Carbon::now();

            $this->userService->createHistoryField($user, $field, Auth::id());
        }

        if ($user->isDirty($field = 'password')) {
            $user->password_changed_at = Carbon::now();

            $this->userService->createHistoryField($user, $field, Auth::id());
        }
    }
}
