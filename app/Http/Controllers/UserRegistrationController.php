<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\UserEmailTakenException;
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
        $data = $request->except(['_token', '_method', 'password_confirmation']);

        try {
            $user = $this->userService->createUserRegular(...$data);
        } catch (UserEmailTakenException $e) {
            return redirect(route('register', false))->with('messages', [
                // @todo i18n
                ['level' => 'info', 'message' => $e->getMessage()]
            ]);
        } catch (\Throwable $th) {
            logger()->error(self::class, ['error' => $th->getMessage()]);
            return redirect(route('register', false))->with('messages', [
                // @todo i18n
                ['level' => 'danger', 'message' => 'Произошла внутренняя ошибка, повторите попытку позже.']
            ]);
        }

        Auth::login($user, true);

        return redirect(route('animes', false))->with('messages', [
            // @todo i18n
            ['level' => 'success', 'message' => 'Успешная регистрация — открыт доступ к лучшим аниме-тайтлам, обсуждениям и манге.']
        ]);
    }
}
