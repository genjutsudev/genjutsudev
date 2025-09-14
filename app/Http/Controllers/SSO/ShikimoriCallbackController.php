<?php

declare(strict_types=1);

namespace App\Http\Controllers\SSO;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ShikimoriCallbackController extends Controller
{
    public function __invoke(UserService $userService): RedirectResponse
    {
        $socialite = Socialite::driver($provider = 'shikimori');
        $ssoUser = $socialite->user();

        try {
            Auth::login($user = $userService->createOrUpdateUserFromSso($ssoUser, $provider));
        } catch (\Exception $e) {
            return redirect()->route('animes')->with('messages', [
                ['level' => 'danger', 'message' => $e->getMessage()]
            ]);
        }

        return redirect()->route('users.show', [$user->nid, $user->profilelink])->with('messages', [
            ['level' => 'success', 'message' => 'OAuth ' . ucfirst($provider) . ' successfully login.'] // @todo i18n
        ]);
    }
}
