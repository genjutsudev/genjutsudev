<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateProfilenameRequest as ProfilenameRequest;
use App\Models\User\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserEditProfilenameController extends Controller
{
    public function show(User $user): View
    {
        return view('sections.users.edit.profilename', compact(['user']));
    }

    public function update(ProfilenameRequest $request, User $user): RedirectResponse
    {
        $profilename = $request->validated('user_profilename');

        try {
            $isUpdated = $user->update(['profilename' => $profilename]);
            $level = $isUpdated ? 'success' : 'warning';
            $message = $isUpdated ? 'Имя профиля успешно обновлено.' : 'Имя профиля обновить не удалось.';
            $routeName = $isUpdated ? 'users.edit.account' : 'users.edit.profilelink';
        } catch (\Throwable $th) {
            $level = 'danger';
            $message = 'Произошла внутренняя ошибка, повторите попытку позже.';
            $routeName = 'users.edit.profilelink';
            logger()->error(self::class, ['error' => $th->getMessage(), 'user_id' => $user->id]);
        }

        return redirect()
            ->route($routeName, [$user->nid, $user->profilelink])
            ->with('messages', [['level' => $level, 'message' => $message]]);
    }
}
