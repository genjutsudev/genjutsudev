<?php

declare(strict_types=1);

namespace App\Http\Controllers\SSO;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\Provider;
use Laravel\Socialite\Facades\Socialite;

abstract class AbstractCallbackController extends Controller
{
    abstract protected function driver(): string;

    public function __invoke(UserService $userService): RedirectResponse
    {
        $socialite = self::provider();
        $ssoUser = $socialite->user();

        try {
            $user = $userService->createUserRegularFromSso($ssoUser, $this->driver());
        } catch (\Exception $e) {
            return redirect()->route('animes')->with('messages', [
                ['level' => 'danger', 'message' => $e->getMessage()]
            ]);
        }

        Auth::login($user, true);

        return redirect()->route('users.show', [$user->nid, $user->profilelink])->with('messages', [
            ['level' => 'success', 'message' => 'OAuth ' . ucfirst($this->driver()) . ' successfully login.']
        ]);
    }

    private function provider(): Provider
    {
        return Socialite::driver($this->driver());
    }
}
