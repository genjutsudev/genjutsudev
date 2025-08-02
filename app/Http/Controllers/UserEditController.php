<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User\User;
use Illuminate\Http\RedirectResponse;

class UserEditController extends Controller
{
    public function redirect(?User $user): RedirectResponse
    {
        if (! $user) {
            abort(404, 'The requested user does not exist.'); // @todo i18n
        }

        return redirect()->route('users.edit.account', [$user->nid, $user->profilelink]);
    }
}
