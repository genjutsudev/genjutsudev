<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\UserUser as User;
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

        /** @var User $user */
        $user = Auth::user();

        // @todo i18n
        return redirect()->intended(route('users.show', [$user->nid, $user->profilelink]))->with('messages', [
            ['level' => 'success', 'message' => "С возвращением, <b>{$user->profilename}</b>!"]
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // @todo i18n
        return redirect(route('animes'))->with('messages', [
            ['level' => 'info', 'message' => "До скорой встречи, <b>{$user->profilename}</b>!"]
        ]);
    }
}
