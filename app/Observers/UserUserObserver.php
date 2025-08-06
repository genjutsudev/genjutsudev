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

            // @todo move somewhere, events?
            $user->historyFields()->create([
                'field' => 'email',
                'value' => $user->getOriginal('email'),
                'changed_id' => auth()->id(),
            ]);
        }

        if ($user->isDirty('password')) {
            $user->password_changed_at = Carbon::now();

            // @todo move somewhere, events?
            $user->historyFields()->create([
                'field' => 'password',
                'value' => $user->getOriginal('password'),
                'changed_id' => auth()->id(),
            ]);
        }
    }
}
