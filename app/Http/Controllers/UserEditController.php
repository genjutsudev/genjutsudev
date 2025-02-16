<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class UserEditController extends Controller
{
    public function redirect(User $user): RedirectResponse
    {
        if (! $user) abort(404);
        return redirect()->route('users.show.edit.account', [$user->uid, $user->profilelink]);
    }
}
