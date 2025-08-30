<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\UserUser as User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class UserPasswordForgotController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(Request $request): View
    {
        /** @var User $user */
        $user = $request->user();

        return view('sections.users.password.forgot', compact(['user']));
    }

    /**
     * Handle an incoming password reset link request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        $status = Password::sendResetLink($request->only('email'));

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }
}
