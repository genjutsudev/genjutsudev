<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class HistoryModelProp extends Model
{
    use HasUuids;

    /**
     * @var string
     */
    public const string ENTITY_TYPE = 'history_model_props';

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
    protected $fillable = ['entity_type', 'entity_id', 'field', 'value', 'changed_id'];

    /**
     * The attributes that cannot be mass assigned.
     *
     * @var array
     */
    protected $guarded = ['id', 'nid', 'created_at', 'changed_id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ['entity_type', 'entity_id'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [];
    }

    public function entity(): MorphTo
    {
        return $this->morphTo();
    }

    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(UserUser::class, 'changed_id', 'id');
    }
}
