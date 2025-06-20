<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\UserTypeEnum;
use App\Models\User\User;
use App\Repositories\UserRepository;
use App\Traits\HasherTrait;
use App\Values\UserTypeValue as Type;
use Illuminate\Support\Str;

class UserService
{
    use HasherTrait;

    public function __construct(
        private readonly UserRepository $repository,
    )
    {
    }

    private function createUser(
        Type $type,
        ?int $referrer_nid = null,
        ?string $email = null,
        ?string $password = null,
        ?string $token = null,
        ?string $api_key = null,
    ) : User
    {
        return User::create([
            'referrer_nid' => $referrer_nid,
            'type' => $type,
            'profilelink' => $default_name = Str::ulid(new \DateTime()),
            'email' => $email,
            'password' => $password_hash = self::hash($password),
            'profilename' => $default_name,
            'registration_ip_hash' => self::hash(request()->ip(), ['memory' => 1024, 'time' => 2, 'threads' => 2]),
            'registration_country' => 'Russian', // @todo
            'token' => $token,
            'api_key' => $api_key,
        ]);
    }

    public function createUserRegular(
        ?int $referrer_nid = null,
        ?string $email = null,
        ?string $password = null,
    ) : User
    {
        return self::createUser(
            type: $type = new Type(UserTypeEnum::REGULAR),
            referrer_nid: $referrer_nid,
            email: $email,
            password: $password,
            token: hash('md5', $type . time()), // @todo
        );
    }

    public function createUserApi(): User
    {
        return self::createUser(
            type: $type = new Type(UserTypeEnum::API),
            api_key: hash('sha256', $type . time()), // @todo
        );
    }
}
