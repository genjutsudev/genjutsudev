<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\UserEmailTakenException;
use App\Models\UserUser as User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
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
            $validated = $request->validate(['password' => ['required', 'string', 'confirmed', Rules\Password::defaults()]]);
            $attrs['password'] = Hash::make($validated['password']);
        }

        $validated = $request->validate(['email' => ['required', 'email']]);
        $attrs['email'] = $validated['email'];

        $level = 'success';
        $message = 'Данные успешно обновлены.';
        $routeName = 'users.edit.account';

        try {
            $this->userService->updateUser($user, $attrs);
            // обнуляем доступ к защищенной части приложения
            request()->session()->put('auth.password_confirmed_at', -1);
        } catch (UserEmailTakenException $e) {
            $level = 'info';
            $message = $e->getMessage();
            $routeName = 'users.edit.password';
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
