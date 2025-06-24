<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Casts\UserGenderCast;
use App\Values\UserGenderValue;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * @property string $id
 * @property int $nid
 * @property-read ?int $referrer_nid
 * @property string $type
 * @property bool $is_active
 * @property ?string $profilelink
 * @property ?string $email
 * @property ?Carbon $email_verified_at
 * @property ?Carbon $email_changed_at
 * @property ?string $password
 * @property ?Carbon $password_changed_at
 * @property ?string $profilename
 * @property ?Carbon $birthday
 * @property UserGenderValue $gender
 * @property float $karma
 * @property float $power
 * @property int $sign_in_count
 * @property-read ?string $registration_ip_hash
 * @property-read ?string $registration_country
 * @property ?string $token
 * @property ?string $api_key
 * @property ?string $remember_token
 * @property Carbon $activity_at
 * @property-read Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    /**
     * @var string
     */
    public const ENTITY_TYPE = 'user_users';

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
        'registration_ip_hash',
        'registration_country',
        'token',
        'activity_at',
        'api_key',
    ];

    /**
     * The attributes that cannot be mass assigned.
     *
     * @var array
     */
    protected $guarded = ['id', 'nid', 'referrer_nid', 'created_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'email_changed_at' => 'datetime',
            'password' => 'hashed',
            'password_changed_at' => 'datetime',
            'birthday' => 'date',
            'gender' => UserGenderCast::class,
            'activity_at' => 'datetime',
        ];
    }

    public function getActivityAt(): Carbon
    {
        return $this->activity_at;
    }
}
