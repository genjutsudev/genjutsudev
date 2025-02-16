<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::query()->orderByDesc('last_activity_at')->paginate(20);
        return view('web.sections.users.index', compact(['users']));
    }

    public function show(User $user): View
    {
        return view('web.sections.users.show.index', compact(['user']));
    }

    public function redirect(User $user): RedirectResponse
    {
        if (! $user) abort(404);
        return redirect()->route('users.show', [$user->uid, $user->profilelink]);
    }
}
