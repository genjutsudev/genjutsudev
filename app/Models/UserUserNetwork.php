<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string $id
 * @property string $identity
 * @property string $network
 * @property-read UserUser $user
 */
class UserUserNetwork extends Model
{
    use HasUuids;

    /**
     * @var string
     */
    public const string ENTITY_TYPE = 'user_user_networks';

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
    protected $fillable = ['network', 'identity'];

    /**
     * The attributes that cannot be mass assigned.
     *
     * @var array
     */
    protected $guarded = ['id', 'nid', 'created_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [];
    }

    public function equals(self $other): bool
    {
        return self::equalsIdentity($other) && self::equalsNetwork($other);
    }

    private function equalsIdentity(self $other): bool
    {
        return $this->identity === $other->identity;
    }

    private function equalsNetwork(self $other): bool
    {
        return $this->network === $other->network;
    }

    public function user(): HasOne
    {
        return $this->hasOne(UserUser::class, 'id', 'user_id');
    }
}
