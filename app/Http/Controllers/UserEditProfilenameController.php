<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserEditProfilenameController extends Controller
{
    public function show(Request $request, User $user): View
    {
        return view('sections.users.edit.profilename', compact(['user']));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        try {
            $status = $user->update(['profilename' => $request->input('user_profilename')]);
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }

        $level = $status ? 'success' : 'warning';
        $message = $status ? 'Изменения успешно сохранены.' : 'Изменения не удалось сохранень.';

        return redirect()
            ->route('users.edit.account', [$user->nid, $user->profilelink])
            ->with('messages', [['level' => $level, 'message' => $message]]);
    }
}
