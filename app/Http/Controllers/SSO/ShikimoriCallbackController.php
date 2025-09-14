<?php

declare(strict_types=1);

namespace App\Http\Controllers\SSO;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ShikimoriCallbackController extends Controller
{
    public function __invoke(UserService $userService)
    {
        $socialite = Socialite::driver($driver = 'shikimori');

        Auth::login($user = $userService->createOrUpdateUserFromSso($socialite->user()));

        return redirect()->route('users.show', [$user->nid, $user->profilelink])->with('messages', [
            ['level' => 'success', 'message' => 'OAuth ' . ucfirst($driver) . ' successfully login.']
        ]);
    }
}
