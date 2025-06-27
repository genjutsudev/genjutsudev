<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateProfilelinkRequest as ProfilelinkRequest;
use App\Models\User\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserEditProfilelinkController extends Controller
{
    public function show(Request $request, User $user): View
    {
        return view('sections.users.edit.profilelink', compact(['user']));
    }

    public function update(ProfilelinkRequest $request, User $user): RedirectResponse
    {
        try {
            $status = $user->update(['profilelink' => $profilelink = $request->input('user_profilelink')]);
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }

        $level = $status ? 'success' : 'warning';
        $message = $status ? 'Изменения успешно сохранены.' : 'Изменения сохранень не удалось.'; // @todo i18n

        return redirect()
            ->route('users.edit.account', [$user->nid, $profilelink])
            ->with('messages', [['level' => $level, 'message' => $message]]);
    }
}
