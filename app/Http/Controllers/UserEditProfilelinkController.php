<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateProfilelinkRequest as ProfilelinkRequest;
use App\Models\User\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserEditProfilelinkController extends Controller
{
    public function show(User $user): View
    {
        return view('sections.users.edit.profilelink', compact(['user']));
    }

    public function update(ProfilelinkRequest $request, User $user): RedirectResponse
    {
        $profilelink = $request->validated('user_profilelink');

        try {
            $isUpdated = $user->update(['profilelink' => $profilelink]);
            $level = $isUpdated ? 'success' : 'warning';
            $message = $isUpdated ? 'Ссылка профиля успешно обновлена.' : 'Ссылку профиля обновить не удалось.';
            $routeName = $isUpdated ? 'users.edit.account' : 'users.edit.profilelink';
        } catch (\Throwable $th) {
            $level = 'danger';
            $message = 'Произошла внутренняя ошибка, повторите попытку позже.';
            $routeName = 'users.edit.profilelink';
            logger()->error(self::class, ['error' => $th->getMessage(), 'user_id' => $user->id]);
        }

        return redirect()
            ->route($routeName, [$user->nid, $profilelink])
            ->with('messages', [['level' => $level, 'message' => $message]]);
    }
}
