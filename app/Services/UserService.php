<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\UserCreatedViaEnum;
use App\Enums\UserTypeEnum;
use App\Exceptions\ProtectedAttributeException;
use App\Exceptions\UserEmailTakenException;
use App\Exceptions\UserProfilelinkMonthlyLimitException;
use App\Exceptions\UserProfilelinkTakenException;
use App\Exceptions\UserProfilenameMonthlyLimitException;
use App\Models\HistoryChangeField;
use App\Models\UserUser as User;
use App\Models\UserUserNetwork as Network;
use App\Models\UserUserPreference as Preferences;
use App\Repositories\UserNetworkRepository as NetworkRepository;
use App\Repositories\UserRepository as UserRepository;
use App\Services\UserNetworkService as NetworkService;
use App\Values\UserCreatedViaValue;
use App\Values\UserTypeValue;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as SsoUser;

readonly class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private NetworkRepository $networkRepository,
        private NetworkService $networkService,
        private HasherService $hasherService,
        private TokenGeneratorService $tokenService,
        private ApiKeyGeneratorService $apiKeyService
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
        $user = User::make([
            'type' => $type,
            'created_via' => $created_via,
            'referrer_nid' => $referrer_nid,
            'profilelink' => Str::ulid(new DateTime()),
            'email' => $email,
            'profilename' => uniqid(),
            'registration_ip_hash' => $this->hasherService->hash(request()->ip(), [
                'memory' => 1024,
                'time' => 2,
                'threads' => 2
            ]),
            'registration_country' => 'Russian', // @todo
            'token' => $token,
            'api_key' => $api_key,
            'password' => $password,
            'password_changed_at' => $password ? now() : null,
        ]);

        // @todo i18n
        throw_if(! $user->save(), new \Exception('Что-то полшо не так, пользователь не создан.'));

        return $user->refresh();
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

        $userType = UserTypeValue::make(
            $is_admin ? UserTypeEnum::ADMIN : UserTypeEnum::REGULAR
        );

        return DB::transaction(function () use ($userType, $created_via, $referrer_nid, $email, $password) {
            $user = self::createUser(
                type: $userType,
                created_via: $created_via,
                referrer_nid: $referrer_nid,
                email: $email,
                password: $password,
                token: $this->tokenService->generate(),
            );

            $user->preferences()->create();

            // @todo move to service
            self::createHistoryField($user, 'password', $user->id);

            return $user;
        });
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
            api_key: $this->apiKeyService->generate()
        );
    }

    public function createUserRegularFromSso(SsoUser $ssoUser, string $driver): User
    {
        $identity = $ssoUser->getId();
        $network_data = ['identity' => $identity, 'network' => $driver];

        if ($network = $this->networkRepository->findFirstWhere($network_data)) {
            return $network->user;
        }

        return DB::transaction(function () use ($network_data) {
            $user = self::createUser(
                type: UserTypeValue::make(UserTypeEnum::REGULAR),
                created_via: UserCreatedViaValue::make(UserCreatedViaEnum::from('oauth')),
                token: $this->tokenService->generate()
            );

            $user->preferences()->create();

            $this->networkService->attachNetwork($user, Network::make($network_data));

            return $user;
        });
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
            /** @var ?User $existing */
            $existing = $this->userRepository->findOneByEmail($attributes['email']);
            throw_if($existing && ! $user->equals($existing, 'email'), new UserEmailTakenException());
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

    public function updateUserSignInCount(User $user): User
    {
        $user->timestamps = false;
        return $this->updateUser($user, ['sign_in_count' => $user->sign_in_count + 1]);
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
            'user_id' => $changed_id,
        ]);
    }
}
