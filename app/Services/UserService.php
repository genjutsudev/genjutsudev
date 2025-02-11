<?php

declare(strict_types=1);

namespace App\Services;

use Sajya\Client\Client;

class UserService
{
    public function __construct(
        private Client $rpc
    ) {
        $this->rpc = $rpc;
    }

    public function createUser()
    {
        $res = $this->rpc->execute('user@list');
        dd($res);
    }
}
