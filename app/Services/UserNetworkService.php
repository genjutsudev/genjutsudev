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

    public function attachNetwork(User $user, Network $network): bool
    {
        $networks = $user->networks;

        /** @var Network $existing */
        if ($existing = $networks->first(fn (Network $n) => $n->equals($network))) {
            // @todo i18n
            throw new \DomainException('Network is already attached.');
        }

        if (! $user->networks()->save($network)) {
            // @todo i18n
            throw new \DomainException('Failed to attach network. Please try again.');
        }

        return true;
    }

    public function detachNetwork(User $user, Network $network): bool
    {
        $networks = $user->networks;

        if ((! $user->email || ! $user->password_changed_at) && $networks->count() === 1) {
            // @todo i18n
            throw new \DomainException('Unable to detach the last identity.');
        }

        /** @var Network $existing */
        if (! $existing = $networks->first(fn (Network $n) => $n->equals($network))) {
            // @todo i18n
            throw new \DomainException('Network is not attached.');
        }

        if (! $existing->delete()) {
            // @todo i18n
            throw new \DomainException('We encountered an issue while disconnecting your account. Please try again later.');
        }

        return true;
    }
}
