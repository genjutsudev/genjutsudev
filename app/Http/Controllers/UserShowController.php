<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\UserUser as User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserShowController extends Controller
{
    public function show(Request $request, User $user): View
    {
        return view('sections.users.show.index', compact(['user']));
    }

//    public function lists(User $user): View
//    {
//        return view('sections.users.show.lists', compact(['user']));
//    }

    public function collections(User $user): View
    {
        return view('sections.users.show.collections', compact(['user']));
    }

    public function featured(User $user): View
    {
        return view('sections.users.show.featured', compact(['user']));
    }

    public function tracked(User $user): View
    {
        return view('sections.users.show.tracked', compact(['user']));
    }

    public function redirect(?User $user): RedirectResponse
    {
        if (! $user) {
            // @todo i18n "The requested user does not exist."
            abort(404, 'Запрошенный пользователь не существует.');
        }

        return redirect()->route('users.show', [$user->nid, $user->profilelink]);
    }
}
