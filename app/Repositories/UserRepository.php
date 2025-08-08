<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\UserUser as User;

class UserRepository extends Repository
{
    public function findOneByEmail(string $email): ?User
    {
        return User::query()->firstWhere('email', $email);
    }

    public function findOneByProfilelink(string $profilelink): ?User
    {
        return User::query()->firstWhere('profilelink', $profilelink);
    }

    public function hasProfilenameMonthlyLimit(User $user, int $limit = 3): bool
    {
        return $user
                ->historyFields('profilename')
                ->whereMonth('created_at', now()->month)
                ->count() >= $limit;
    }
}
