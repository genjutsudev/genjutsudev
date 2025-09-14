<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\UserUser as User;
use App\Models\UserUserNetwork as Network;

class UserNetworkService
{
    public function __construct()
    {
    }

    public function attachNetwork(User $user, Network $network): void
    {
        $networks = $user->networks;

        /** @var Network $existing */
        if ($existing = $networks->first(fn (Network $n) => $n->equals($network))) {
            throw new \DomainException('Network is already attached.'); // @todo i18n
        }

//        /** @var Network $existing */
//        foreach ($networks as $existing) {
//            if ($existing->equals($network)) {
//                throw new \DomainException('Network is already attached.');
//            }
//        }

        $user->networks()->save($network);
    }

    public function detachNetwork(User $user, Network $network): void
    {
        $networks = $user->networks;

        if ((! $user->email || ! $user->password_changed_at) && $networks->count() === 1) {
            throw new \DomainException('Unable to detach the last identity.'); // @todo i18n
        }

        /** @var Network $existing */
        if (! $existing = $networks->first(fn (Network $n) => $n->equals($network))) {
            throw new \DomainException('Network is not attached.'); // @todo i18n
        }

        $existing->delete();

//        /** @var Network $existing */
//        foreach ($networks as $existing) {
//            if ((! $user->email || ! $user->password_changed_at) && $networks->count() === 1) {
//                throw new \DomainException('Unable to detach the last identity.');
//            }
//
//            if (! $existing->equals($network)) {
//                $existing->delete();
//                return;
//            }
//        }
//
//        throw new \DomainException('Network is not attached.');
    }
}
