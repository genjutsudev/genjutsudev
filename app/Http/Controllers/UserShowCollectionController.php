<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\UserUser as User;
use Illuminate\Http\RedirectResponse as Redirect;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserShowCollectionController extends Controller
{
    public function anime(Request $request, User $user): Redirect | View
    {
        if (! $request->has('list')) {
            return redirect()->route('users.show.collections.anime', [
                $user->nid, $user->profilelink, 'list' => 'watching'
            ]);
        }

        return view('sections.users.show.collections', compact(['user']));
    }
}
