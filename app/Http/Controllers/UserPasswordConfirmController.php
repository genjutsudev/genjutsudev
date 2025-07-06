<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserPasswordConfirmController extends Controller
{
    /**
     * Show the confirm password view.
     */
    public function show(Request $request): View
    {
        $user = $request->user();

        return view('sections.users.password.confirm', compact(['user']));
    }

    /**
     * Confirm the user's password.
     */
    public function store(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();

        if (! Auth::guard('web')->validate([
            'email' => $user->email,
            'password' => $request->input('user_password'),
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password')
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended('/');
    }
}
