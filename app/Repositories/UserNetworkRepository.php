<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\UserUserNetwork as UserNetwork;

class UserNetworkRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(UserNetwork::class);
    }

    public function hasNetwork(UserNetwork $network): bool
    {
        return ! empty($this->findFirstWhere(['identity' => $network->identity, 'network' => $network->network]));
    }
}
