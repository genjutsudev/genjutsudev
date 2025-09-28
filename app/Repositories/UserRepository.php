<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\UserUser as User;

class UserRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function findOneByEmail(string $email): ?User
    {
        /** @var ?User $user */
        $user = $this->findFirstWhere(['email' => $email]);
        return $user;
    }

    public function findOneByProfilelink(string $profilelink): ?User
    {
        /** @var ?User $user */
        $user = $this->findFirstWhere(['profilelink' => $profilelink]);
        return $user;
    }

    private function hasMonthlyLimit(User $user, string $fieldName, int $limit): bool
    {
        return $this->getCountMonthlyLimit($user, $fieldName) >= $limit;
    }

    public function hasProfilelinkMonthlyLimit(User $user, int $limit): bool
    {
        return $this->hasMonthlyLimit($user, 'profilelink', $limit);
    }

    public function hasProfilenameMonthlyLimit(User $user, int $limit): bool
    {
        return $this->hasMonthlyLimit($user, 'profilename', $limit);
    }

    private function getCountMonthlyLimit(User $user, string $fieldName): int
    {
        return $user->historyFields($fieldName)->whereMonth('created_at', now()->month)->count();
    }

    public function getCountProfilelinkMonthlyLimit(User $user): int
    {
        return $this->getCountMonthlyLimit($user, 'profilelink');
    }

    public function getCountProfilenameMonthlyLimit(User $user): int
    {
        return $this->getCountMonthlyLimit($user, 'profilename');
    }
}
