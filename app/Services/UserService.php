<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\UserTypeEnum;
use App\Exceptions\ProtectedAttributeException;
use App\Exceptions\UserAlreadyExistException;
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
        if (! $type->isApi()) {
            throw_if($this->repository->findOneByEmail($email), new UserAlreadyExistException());
        }

        return User::create([
            'referrer_nid' => $referrer_nid,
            'type' => $type,
            'profilelink' => Str::ulid(new \DateTime()),
            'email' => $email,
            'password' => self::hash($password),
            'profilename' => uniqid(),
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
            type: $type = Type::make(UserTypeEnum::REGULAR),
            referrer_nid: $referrer_nid,
            email: $email,
            password: $password,
            token: hash('md5', $type . time()), // @todo
        );
    }

    public function createUserApi(): User
    {
        return self::createUser(
            type: $type = Type::make(UserTypeEnum::API),
            api_key: hash('sha256', $type . time()), // @todo
        );
    }

    public function updateUser(
        User $user,
        array $attributes,
        array $options = []
    ) : User
    {
        foreach (array_keys($attributes) as $attributeName) {
            throw_if(! in_array($attributeName, [
                'is_active',
                'profilelink',
                'email',
                'email_verified_at',
                'email_changed_at',
                'password',
                'password_changed_at',
                'profilename',
                'birthday',
                'gender',
                'karma',
                'power',
                'sign_in_count',
                'token',
                'api_key',
                'remember_token',
                'activity_at'
            ]), new ProtectedAttributeException($attributeName));
        }

        $user->update($attributes, $options);

        return $user;
    }
}
