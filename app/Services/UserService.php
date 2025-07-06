<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\UserTypeEnum;
use App\Exceptions\ProtectedAttributeException;
use App\Exceptions\UserEmailTakenException;
use App\Models\User\User;
use App\Models\User\UserPreference as Preferences;
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
        /** @var User $user */
        $user = User::create([
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

        return $user->load('preferences');
    }

    private function createUserRegularOrAdmin(
        string $email,
        string $password,
        ?int $referrer_nid = null,
        ?bool $is_admin = false,
    ) : User
    {
        throw_if($this->repository->findOneByEmail($email), new UserEmailTakenException());

        $user = self::createUser(
            type: $type = Type::make($is_admin ? UserTypeEnum::ADMIN : UserTypeEnum::REGULAR),
            referrer_nid: $referrer_nid,
            email: $email,
            password: $password,
            token: hash('md5', $type . time()),
        );

        $user->preferences()->create();

        return $user->load('preferences');
    }

    public function createUserRegular(
        string $email,
        string $password,
        ?int $referrer_nid = null,
    ) : User
    {
        return self::createUserRegularOrAdmin(
            email: $email,
            password: $password,
            referrer_nid: $referrer_nid
        );
    }

    public function createUserAdmin(
        string $email,
        string $password,
    ) : User
    {
        return self::createUserRegularOrAdmin(
            email: $email,
            password: $password,
            is_admin: true
        );
    }

    /*
     * @todo
     */
    public function createUserApi(): User
    {
        return self::createUser(
            type: $type = Type::make(UserTypeEnum::API),
            api_key: hash('sha256', $type . time())
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

        if (array_key_exists('email', $attributes)) {
            /** @var ?User $found */
            $found = $this->repository->findOneByEmail($attributes['email']);
            throw_if($found && ! $user->equals($found, 'email'), new UserEmailTakenException());
        }

        $user->update($attributes, $options);

        return $user;
    }

    /*
     * @todo
     */
    public function updateUserRegular(
        User $user,
        array $attrs = [],
        bool $is_admin = false
    ) : User
    {
        return self::updateUser($user, $attrs);
    }

    /*
     * @todo
     */
    public function updateUserApi(
        User $user,
        array $attrs = [],
    ) : User
    {
        return self::updateUser($user, $attrs);
    }

    public function updatePreferences(
        User $user,
        array $attributes,
        array $options = []
    ) : Preferences
    {
        $preference = $user->preferences;

        $preference->update($attributes, $options);

        return $preference;
    }
}
