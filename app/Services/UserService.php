<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        private readonly UserRepository $repository,
    )
    {
    }

    public function createUser(string $email, string $password): User
    {
        return User::create([
            'name' => uniqid(),
            'email' => $email,
            'password' => $password_hash = Hash::make($password),
        ]);
    }
}
