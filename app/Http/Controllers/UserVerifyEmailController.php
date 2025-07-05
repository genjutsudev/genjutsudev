<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserVerifyEmailController extends Controller
{
    public function store(Request $request): RedirectResponse
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
