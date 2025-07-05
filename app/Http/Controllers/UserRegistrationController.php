<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\UserAlreadyExistException;
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
        $data = $request->except(['_token', 'password_confirmation']);

        try {
            $user = $this->userService->createUserRegular(...$data);
        } catch (UserAlreadyExistException $e) {
            self::info($e->getMessage());
            return redirect(route('register', false));
        } catch (\Throwable $th) {
            logger()->error(self::class, ['error' => $th->getMessage()]);

            self::danger('Произошла внутренняя ошибка, повторите попытку позже.'); // @todo i18n
            return redirect(route('register', false));
        }

        Auth::login($user, true);

        self::success('Успешная регистрация — открыт доступ к лучшим аниме-тайтлам, обсуждениям и манге.'); // @todo i18n
        return redirect(route('animes', false));
    }
}
