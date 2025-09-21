<?php

declare(strict_types=1);

namespace App\Http\Controllers\SSO;

use App\Http\Controllers\Controller;
use App\Models\UserUser as User;
use App\Models\UserUserNetwork as Network;
use App\Services\UserNetworkService as NetworkService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\Provider;
use Laravel\Socialite\Contracts\User as SsoUser;
use Laravel\Socialite\Facades\Socialite;

abstract class AbstractCallbackController extends Controller
{
    abstract protected function driver(): string;

    public function __construct(
        private readonly UserService $userService,
        private readonly NetworkService $networkService
    )
    {
    }

    public function __invoke(): RedirectResponse
    {
        $socialite = self::provider();
        $ssoUser = $socialite->user();

        try {
            if (Auth::check()) {
                return self::handleNetworkAttach($ssoUser);
            }

            return self::handleLoginOrRegister($ssoUser);
        } catch (\Exception $e) {
            logger()->error(self::class, ['message' => $e->getMessage()]);
            return redirect()->route('animes')->with('messages', [
                ['level' => 'danger', 'message' => $e->getMessage()]
            ]);
        }
    }

    private function provider(): Provider
    {
        return Socialite::driver($this->driver());
    }

    private function handleNetworkAttach(SsoUser $ssoUser): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        /** @var Network $network */
        $network = Network::make([
            'identity' => $ssoUser->getId(),
            'network'  => $this->driver(),
        ]);

        $this->networkService->attachNetwork($user, $network);

        return redirect()->route('users.edit.account', [$user->nid, $user->profilelink])->with('messages', [
            // @todo i18n
            ['level' => 'success', 'message' => 'Attach ' . ucfirst($this->driver()) . ' successfully.']
        ]);
    }

    private function handleLoginOrRegister(SsoUser $ssoUser): RedirectResponse
    {
        $user = $this->userService->createUserRegularFromSso($ssoUser, $this->driver());

        Auth::login($user, true);

        return redirect()->route('users.show', [$user->nid, $user->profilelink])->with('messages', [
            // @todo i18n
            ['level' => 'success', 'message' => 'OAuth ' . ucfirst($this->driver()) . ' successfully login.']
        ]);
    }
}
