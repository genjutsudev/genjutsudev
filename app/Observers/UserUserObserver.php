<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\UserUser as User;
use Illuminate\Support\Carbon;

class UserUserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if ($user->wasChanged(['email'])) {
            $user->email_verified_at = null;
            $user->email_changed_at = Carbon::now();
        }

        if ($user->wasChanged(['password'])) {
            $user->password_changed_at = Carbon::now();
        }

        if ($user->isDirty(['email_changed_at', 'password_changed_at'])) {
            $user->save();
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
