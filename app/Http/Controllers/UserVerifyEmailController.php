<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\UserUser as User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class UserVerifyEmailController extends Controller
{
    public function store(EmailVerificationRequest $request): RedirectResponse
    {
        /** @var User|MustVerifyEmail $user */
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            self::info('Эл. почта уже подтверждена.'); // @todo i18n
            return redirect()->route('users.edit.account', [
                $user->nid, $user->profilelink, http_build_query(['verified' => 1])
            ]);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        self::success('Эл. почта успешно подтверждена.'); // @todo i18n
        return redirect()->route('users.edit.account', [
            $user->nid, $user->profilelink, http_build_query(['verified' => 1])
        ]);
    }
}
