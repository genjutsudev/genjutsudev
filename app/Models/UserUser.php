<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Casts\UserCreatedViaCast;
use App\Casts\UserGenderCast;
use App\Casts\UserTypeCast;
use App\Values\UserCreatedViaValue;
use App\Values\UserGenderValue;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * Основная
 * @property string $id
 * @property int $nid
 * @property-read string $type
 * @property bool $is_active
 * @property UserCreatedViaValue $created_via
 * @property-read Carbon $created_at
 * @property Carbon $updated_at
 * Профиль
 * @property ?string $profilename
 * @property ?string $profilelink
 * @property ?Carbon $birthday
 * @property UserGenderValue $gender
 * Учетные данные
 * @property ?string $email
 * @property ?Carbon $email_verified_at
 * @property ?Carbon $email_changed_at
 * @property ?string $password
 * @property ?Carbon $password_changed_at
 * Статистика
 * @property float $karma
 * @property float $power
 * @property int $sign_in_count
 * @property Carbon $activity_at
 * Реферальные связи
 * @property-read ?int $referrer_nid
 * Токены и ключи
 * @property ?string $token
 * @property ?string $api_key
 * @property ?string $remember_token
 * Другое
 * @property-read ?string $registration_ip_hash
 * @property-read ?string $registration_country
 * Связи
 * @property UserUserPreference $preferences
 */
class UserUser extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    /**
     * @var string
     */
    public const string ENTITY_TYPE = 'user_users';

    /**
     * @var string
     */
    protected $table = self::ENTITY_TYPE;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'referrer_nid',
        'type',
        'profilelink',
        'email',
        'password',
        'profilename',
        'birthday',
        'gender',
        'registration_ip_hash',
        'registration_country',
        'token',
        'activity_at',
        'api_key',
        'created_via',
    ];

    /**
     * The attributes that cannot be mass assigned.
     *
     * @var array
     */
    protected $guarded = ['id', 'nid', 'referrer_nid', 'type', 'created_at', 'created_via'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => UserTypeCast::class,
            'email_verified_at' => 'datetime',
            'email_changed_at' => 'datetime',
            'password' => 'hashed',
            'password_changed_at' => 'datetime',
            'birthday' => 'date',
            'gender' => UserGenderCast::class,
            'activity_at' => 'datetime',
            'created_via' => UserCreatedViaCast::class
        ];
    }

    public function equals(?self $other, string $attribute = 'id'): bool
    {
        return $this->$attribute === $other?->$attribute;
    }

    public function preferences(): HasOne
    {
        return $this->hasOne(UserUserPreference::class, 'user_id');
    }
}
