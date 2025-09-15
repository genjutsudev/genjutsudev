<?php

declare(strict_types=1);

namespace App\Http\Controllers\SSO;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

abstract class AbstractCallbackController extends Controller
{
    abstract protected function driver(): string;

    public function __invoke(UserService $userService): RedirectResponse
    {
        $driver = $this->driver();

        $socialite = Socialite::driver($driver);
        $ssoUser = $socialite->user();

        try {
            $user = $userService->createUserRegularFromSso($ssoUser, $driver);
        } catch (\Exception $e) {
            return redirect()->route('animes')->with('messages', [
                ['level' => 'danger', 'message' => $e->getMessage()]
            ]);
        }

        Auth::login($user, true);

        return redirect()->route('users.show', [$user, $user->profilelink])->with('messages', [
            // @todo i18n
            ['level' => 'success', 'message' => 'OAuth ' . ucfirst($driver) . ' successfully login.']
        ]);
    }
}
