<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::query()->orderByDesc('activity_at')->paginate(20);
        return view('sections.users.index', compact(['users']));
    }

    public function show(User $user): View
    {
        return view('sections.users.show.index', compact(['user']));
    }

    public function redirect(?User $user): RedirectResponse
    {
        if (! $user) {
            abort(404, 'The requested user does not exist.');
        }

        return redirect()->route('users.show', [$user->nid, $user->profilelink]);
    }
}
