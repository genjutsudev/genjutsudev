<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserVerificationEmailController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function show(Request $request): View
    {
        /** @var User $user */
        $user = $request->user();

        return view('sections.users.verification.email.verify', compact(['user']));
    }

    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended('/');
        }

        $user->sendEmailVerificationNotification();

        self::info('На эл. почту, указанную при регистрации, была отправлена ссылка для подтверждения.'); // @todo i18n
        return redirect()->route('users.edit.account', [$user->nid, $user->profilelink]);
    }

}
