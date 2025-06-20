<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserRegistrationController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    )
    {
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('sections.users.sign-up');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        try {
            Auth::login($this->userService->createUserRegular(...$request->except(['_token', 'password_confirmation'])));
        } catch (\Throwable $th) {
            self::danger('Системная ошибка. Повторите запрос позже.');
            return redirect(route('register', false));
        }

        self::success('Регистрация прошла успешно! Добро пожаловать!');
        return redirect(route('animes', false));
    }
}
