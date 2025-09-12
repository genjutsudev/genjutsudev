<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\UserCreatedViaEnum;
use App\Enums\UserTypeEnum;
use App\Exceptions\ProtectedAttributeException;
use App\Exceptions\UserEmailTakenException;
use App\Exceptions\UserProfilelinkMonthlyLimitException;
use App\Exceptions\UserProfilenameMonthlyLimitException;
use App\Exceptions\UserProfilelinkTakenException;
use App\Models\HistoryChangeField;
use App\Models\UserUser as User;
use App\Models\UserUserPreference as Preferences;
use App\Repositories\UserRepository;
use App\Traits\HasherTrait;
use App\Values\UserCreatedViaValue;
use App\Values\UserTypeValue;
use DateTime;
use Illuminate\Support\Str;

class UserService
{
    use HasherTrait;

    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    private function createUser(
        UserTypeValue $type,
        UserCreatedViaValue $created_via,
        ?int $referrer_nid = null,
        ?string $email = null,
        ?string $password = null,
        ?string $token = null,
        ?string $api_key = null
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
        UserCreatedViaValue $created_via,
        string $email,
        string $password,
        bool $is_admin,
        ?int $referrer_nid = null
    ) : User
    {
        throw_if($this->userRepository->findOneByEmail($email), new UserEmailTakenException());

        $userType = UserTypeValue::make($is_admin ? UserTypeEnum::ADMIN : UserTypeEnum::REGULAR);

        $user = self::createUser(
            type: $userType,
            created_via: $created_via,
            referrer_nid: $referrer_nid,
            email: $email,
            password: $password,
            token: hash('md5', $userType . time()),
        );

        $user->preferences()->create();

        self::createHistoryField($user, 'password', $user->id);

        return $user->load('preferences');
    }

    /*
     * @todo
     */
    public function createOrUpdateUserFromSso(
        string $network,
        string $identity
    )
    {
    }

    public function createUserRegular(
        string $email,
        string $password,
        string $created_via = 'web',
        ?int $referrer_nid = null
    ) : User
    {
        $userCreatedVia = UserCreatedViaValue::make(UserCreatedViaEnum::from($created_via));
        return self::createUserRegularOrAdmin(
            created_via: $userCreatedVia,
            email: $email,
            password: $password,
            is_admin: false,
            referrer_nid: $referrer_nid,
        );
    }

    public function createUserAdmin(
        string $email,
        string $password,
        string $created_via = 'web'
    ) : User
    {
        $userCreatedVia = UserCreatedViaValue::make(UserCreatedViaEnum::from($created_via));
        return self::createUserRegularOrAdmin(
            created_via: $userCreatedVia,
            email: $email,
            password: $password,
            is_admin: true,
        );
    }

    public function createUserApi(
        string $created_via = 'web'
    ) : User
    {
        $userType = UserTypeValue::make(UserTypeEnum::API);
        $userCreatedVia = UserCreatedViaValue::make(UserCreatedViaEnum::from($created_via));
        return self::createUser(
            type: $userType,
            created_via: $userCreatedVia,
            api_key: hash('sha256', $userType . time())
        );
    }

    /*
     * @todo make private
     */
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
                'activity_at',
            ]), new ProtectedAttributeException($attributeName));
        }

        if (array_key_exists('email', $attributes)) {
            /** @var ?User $found */
            $found = $this->userRepository->findOneByEmail($attributes['email']);
            throw_if($found && ! $user->equals($found, 'email'), new UserEmailTakenException());
        }

        $user->update($attributes, $options);

        return $user;
    }

    public function updateUserProfilelink(
        User $user,
        string $profilelink
    ) : User
    {
        // @todo param "limit" move to .env file or in database in table "users"
        if ($this->userRepository->hasProfilelinkMonthlyLimit($user, $limit = 1)) {
            throw new UserProfilelinkMonthlyLimitException($limit);
        }

        if ($this->userRepository->findOneByProfilelink($profilelink)) {
            throw new UserProfilelinkTakenException();
        }

        return self::updateUser($user, ['profilelink' => $profilelink]);
    }

    public function updateUserProfilename(
        User $user,
        string $profilename
    ) : User
    {
        // @todo param "limit" move to .env file or in database in table "users"
        if ($this->userRepository->hasProfilenameMonthlyLimit($user, $limit = 3)) {
            throw new UserProfilenameMonthlyLimitException($limit);
        }

        return self::updateUser($user, ['profilename' => $profilename]);
    }

    /*
     * @todo make private, refactored
     */
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

    /*
     * @todo createFieldChangeRecord
     */
    public function createHistoryField(
        User $user,
        string $field_name,
        string $changed_id
    ) : HistoryChangeField
    {
        return $user->historyFields()->create([
            'field' => $field_name,
            'value' => $user->getOriginal($field_name),
            'changed_id' => $changed_id,
        ]);
    }
}
