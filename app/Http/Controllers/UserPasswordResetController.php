<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UserPasswordResetController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('sections.users.password.reset');
    }

    /**
     * Handle an incoming new password request.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($validated) {
                $user->forceFill([
                    'password' => Hash::make($validated['password']),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('animes')->with('messages', [
                ['level' => 'success', 'message' => __($status)]
            ]);
        }

        return back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }
}
