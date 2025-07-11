<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserAuthenticatedController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()//: View
    {
        //return view('auth.login');
        return redirect('/animes'); // @todo Something
    }

    /**
     * Handle an incoming authentication request.
     *
     * @throws ValidationException
     */
    public function store(UserLoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        self::success('С возвращением, <b>' . $user->profilename . '</b>!'); // @todo i18n
        return redirect()->intended(route('animes', false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        self::info('До скорой встречи, <b>' . $user->profilename . '</b>!'); // @todo i18n
        return redirect(route('animes'));
    }
}
