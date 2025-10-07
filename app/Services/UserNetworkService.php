<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\UserUser as User;
use App\Models\UserUserNetwork as Network;
use App\Repositories\UserNetworkRepository as NetworkRepository;

class UserNetworkService
{
    public function __construct(
        readonly NetworkRepository $networkRepository
    )
    {
    }

    public function attachNetwork(User $user, Network $network): bool
    {
        $networks = $user->networks;

        if ($this->networkRepository->hasNetwork($network)) {
            // @todo i18n
            throw new \DomainException('Сеть уже используется.');
        }

        /** @var Network $existing */
        if ($existing = $networks->first(fn (Network $n) => $n->equals($network))) {
            // @todo i18n "Network is already attached."
            throw new \DomainException('Сеть уже привязана.');
        }

        if (! $user->networks()->save($network)) {
            // @todo i18n "Failed to attach network. Please try again."
            throw new \DomainException('Не удалось привязать сеть. Пожалуйста, попробуйте еще раз.');
        }

        return true;
    }

    public function detachNetwork(User $user, Network $network): bool
    {
        $networks = $user->networks;

        if ((! $user->email || ! $user->password_changed_at) && $networks->count() === 1) {
            // @todo i18n "Unable to detach the last identity."
            throw new \DomainException('Это ваш единственный способ входа. Добавьте email или другой способ входа.');
        }

        /** @var Network $existing */
        if (! $existing = $networks->first(fn (Network $n) => $n->equals($network))) {
            // @todo i18n "Network is not attached."
            throw new \DomainException('Эта социальная сеть не связана с вашим аккаунтом.');
        }

        if (! $existing->delete()) {
            // @todo i18n "We encountered an issue while disconnecting your account. Please try again later."
            throw new \DomainException('Не удалось отвязать социальную сеть. Пожалуйста, повторите попытку.');
        }

        return true;
    }
}
