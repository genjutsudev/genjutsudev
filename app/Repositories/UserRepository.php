<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User\User;

class UserRepository extends Repository
{
    public function findOneByEmail(string $email): ?User
    {
        return User::query()->firstWhere('email', $email);
    }
}
