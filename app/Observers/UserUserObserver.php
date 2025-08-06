<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\UserUser as User;
use Illuminate\Support\Carbon;

class UserUserObserver
{
    /**
     * Handle the User "updating" event.
     */
    public function updating(User $user): void
    {
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
            $user->email_changed_at = Carbon::now();
        }

        if ($user->isDirty('password')) {
            $user->password_changed_at = Carbon::now();
        }
    }
}
