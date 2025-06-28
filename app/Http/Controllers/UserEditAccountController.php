<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateAccountRequest as AccountRequest;
use App\Models\User\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class UserEditAccountController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    )
    {
    }

    public function show(Request $request, User $user): View
    {
        $preferences = $user->preferences;
        return view('sections.users.edit.account', compact(['user', 'preferences']));
    }

    public function update(AccountRequest $request, User $user): RedirectResponse
    {
        $user_birthday = array_reverse($request->validated('user_birthday'));
        $user_gender = $request->validated('user_gender');
        $user_preferences = $request->validated('user_preferences');

        $birthday = Carbon::createFromDate(...$user_birthday);

        $level = 'success';
        $message = 'Изменения успешно сохранены.';
        $routeName = 'users.edit.account';

        try {
            $this->userService->updateUser($user, ['birthday' => $birthday, 'gender' => $user_gender]);
            $this->userService->updatePreferences($user, [
                'is_show_age' => isset($user_preferences['is_show_age']),
                'is_view_censored' => isset($user_preferences['is_view_censored'])
            ]);
        } catch (\Throwable $th) {
            $level = 'danger';
            $message = 'Произошла внутренняя ошибка, повторите попытку позже.';
            logger()->error(self::class, ['error' => $th->getMessage(), 'user_id' => $user->id]);
        }

        return redirect()
            ->route($routeName, [$user->nid, $user->profilelink])
            ->with('messages', [['level' => $level, 'message' => $message]]);
    }
}
