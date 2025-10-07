<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\UserUser as User;
use Illuminate\Http\RedirectResponse;

class UserEditController extends Controller
{
    public function redirect(?User $user): RedirectResponse
    {
        if (! $user) {
            // @todo i18n "The requested user does not exist."
            abort(404, 'Запрошенный пользователь не существует.');
        }

        return redirect()->route('users.edit.account', [$user->nid, $user->profilelink]);
    }
}
