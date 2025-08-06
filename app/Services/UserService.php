<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\UserCreatedViaEnum;
use App\Enums\UserTypeEnum;
use App\Exceptions\ProtectedAttributeException;
use App\Exceptions\UserEmailTakenException;
use App\Models\UserUser as User;
use App\Models\UserUserPreference as Preferences;
use App\Repositories\UserRepository;
use App\Traits\HasherTrait;
use App\Values\UserCreatedViaValue as CreatedVia;
use App\Values\UserTypeValue as Type;
use DateTime;
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
        CreatedVia $created_via,
        ?int $referrer_nid = null,
        ?string $email = null,
        ?string $password = null,
        ?string $token = null,
        ?string $api_key = null,
    ) : User
    {
        /** @var User $user */
        $user = User::create([
            'type' => $type,
            'created_via' => $created_via,
            'referrer_nid' => $referrer_nid,
            'profilelink' => Str::ulid(new DateTime()),
            'email' => $email,
            'password' => ! empty($password) ? self::hash($password) : null,
            'profilename' => uniqid(),
            'registration_ip_hash' => self::hash(request()->ip(), ['memory' => 1024, 'time' => 2, 'threads' => 2]),
            'registration_country' => 'Russian', // @todo
            'token' => $token,
            'api_key' => $api_key,
        ]);

        return $user;
    }

    private function createUserRegularOrAdmin(
        string $email,
        string $password,
        string $created_via = 'web',
        ?int $referrer_nid = null,
        ?bool $is_admin = false,
    ) : User
    {
        throw_if($this->repository->findOneByEmail($email), new UserEmailTakenException());

        $user = self::createUser(
            type: $type = Type::make($is_admin ? UserTypeEnum::ADMIN : UserTypeEnum::REGULAR),
            created_via: CreatedVia::make(UserCreatedViaEnum::from($created_via)),
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
        string $created_via = 'web',
        ?int $referrer_nid = null,
    ) : User
    {
        return self::createUserRegularOrAdmin(
            email: $email,
            password: $password,
            created_via: $created_via,
            referrer_nid: $referrer_nid,
        );
    }

    public function createUserAdmin(
        string $email,
        string $password,
        string $created_via = 'web',
    ) : User
    {
        return self::createUserRegularOrAdmin(
            email: $email,
            password: $password,
            created_via: $created_via,
            is_admin: true,
        );
    }

    // @todo
    public function createUserApi(
        string $created_via = 'web',
    ) : User
    {
        $type = Type::make(UserTypeEnum::API);
        $created_via = CreatedVia::make(UserCreatedViaEnum::from($created_via));
        return self::createUser(
            type: $type,
            created_via: $created_via,
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
                // @todo move in DTO
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
                'activity_at',
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

    // @todo
    public function updateUserRegular(
        User $user,
        array $attrs = [],
        bool $is_admin = false
    ) : User
    {
        return self::updateUser($user, $attrs);
    }

    // @todo
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

    public function createHistoryField(
        User $user,
        string $fieldName,
        string $changedId
    )
    {
        return $user->historyFields()->create([
            'field' => $fieldName,
            'value' => $user->getOriginal($fieldName),
            'changed_id' => $changedId,
        ]);
    }
}
