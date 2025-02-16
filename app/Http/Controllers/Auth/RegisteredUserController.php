<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function __construct(private UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('web.sections.users.sign-up');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $user = $this->userService->createUser($request->all());
        } catch (\Throwable $th) {
            self::danger('Системная ошибка. Повторите запрос позже.');
            return redirect(route('register', absolute: false));
        }

        Auth::login($user);

        self::success('Регистрация прошла успешно! Добро пожаловать!');
        return redirect(route('animes', absolute: false));
    }
}
