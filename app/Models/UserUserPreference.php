<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class UserUserPreference extends Model
{
    use HasUuids;

    /**
     * @var string
     */
    public const ENTITY_TYPE = 'user_user_preferences';

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
        'is_view_censored',
        'is_show_age',
        'comments_in_profile',
        'achievements_in_profile'
    ];

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
}
