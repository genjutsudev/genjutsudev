<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Sajya\Client\Client;

class UserService
{
    public function __construct(private Client $rpc) {
        $this->rpc = $rpc;
    }

    public function createUser(array $data): User
    {
        $res = $this->rpc->execute('user@create', $data);

        if ($res->error()) {
            throw new \Exception('Что-то пошло не так. Попробуйте позже.');
        }

        $user = $res->result();

        return User::where('id', $user['id'])->first();
    }
}
