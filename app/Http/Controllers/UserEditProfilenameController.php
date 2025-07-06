<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateProfilenameRequest as ProfilenameRequest;
use App\Models\User\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserEditProfilenameController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    )
    {
    }

    public function show(User $user): View
    {
        return view('sections.users.edit.profilename', compact(['user']));
    }

    public function update(ProfilenameRequest $request, User $user): RedirectResponse
    {
        $user_profilename = $request->validated('user_profilename');

        $level = 'success';
        $message = 'Имя профиля успешно обновлено.';
        $routeName = 'users.edit.account';

        try {
            $this->userService->updateUser($user, ['profilename' => $user_profilename]);
        } catch (\Throwable $th) {
            $level = 'danger';
            $message = 'Произошла внутренняя ошибка, повторите попытку позже.';
            $routeName = 'users.edit.profilename';
            logger()->error(self::class, ['error' => $th->getMessage(), 'user_id' => $user->id]);
        }

        return redirect()
            ->route($routeName, [$user->nid, $user->profilelink])
            ->with('messages', [['level' => $level, 'message' => $message]]);
    }
}
