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

    private function hasMonthlyLimit(User $user, string $fieldName, int $limit): bool
    {
        return self::getCountMonthlyLimit($user, $fieldName) >= $limit;
    }

    public function hasProfilelinkMonthlyLimit(User $user, int $limit): bool
    {
        return self::hasMonthlyLimit($user, 'profilelink', $limit);
    }

    public function hasProfilenameMonthlyLimit(User $user, int $limit): bool
    {
        return self::hasMonthlyLimit($user, 'profilename', $limit);
    }

    private function getCountMonthlyLimit(User $user, string $fieldName): int
    {
        return $user->historyFields($fieldName)->whereMonth('created_at', now()->month)->count();
    }

    public function getCountProfilelinkMonthlyLimit(User $user): int
    {
        return self::getCountMonthlyLimit($user, 'profilelink');
    }

    public function getCountProfilenameMonthlyLimit(User $user): int
    {
        return self::getCountMonthlyLimit($user, 'profilename');
    }
}
