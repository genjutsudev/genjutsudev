<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UserEditPasswordController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    )
    {
    }

    public function show(User $user): View
    {
        return view('sections.users.edit.password', compact(['user']));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $attrs = [];

        if ($request->input('password')) {
            $validated = $request->validate(['password' => ['required', Password::defaults(), 'confirmed']]);
            $attrs['password'] = Hash::make($validated['password']);
        }

        $attrs['email'] = $request->input('email');

        $level = 'success';
        $message = 'Данные успешно обновлены.';
        $routeName = 'users.edit.account';

        try {
            $this->userService->updateUser($user, $attrs);
        } catch (\Throwable $th) {
            $level = 'danger';
            $message = 'Произошла внутренняя ошибка, повторите попытку позже.';
            $routeName = 'users.edit.password';
            logger()->error(self::class, ['error' => $th->getMessage(), 'user_id' => $user->id]);
        }

        return redirect()
            ->route($routeName, [$user->nid, $user->profilelink])
            ->with('messages', [['level' => $level, 'message' => $message]]);
    }
}
