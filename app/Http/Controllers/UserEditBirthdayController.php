<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateBirthdayRequest;
use App\Models\UserUser as User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class UserEditBirthdayController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    )
    {
    }

    public function show(User $user): View
    {
        return view('sections.users.edit.birthday', compact(['user']));
    }

    public function update(UserUpdateBirthdayRequest $request, User $user): RedirectResponse
    {
        $user_birthday = array_reverse($request->validated('user_birthday'));

        $birthday = Carbon::createFromDate(...$user_birthday);

        $level = 'success';
        $message = 'Дата рождения успешно сохранена.';
        $routeName = 'users.edit.account';

        try {
            $this->userService->updateUser($user, ['birthday' => $birthday]);
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
