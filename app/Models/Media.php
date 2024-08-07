<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $file_name
 * @property int $entity_id
 * @property string $entity_type
 * @property bool $primary
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Animal|Post $entity
 * @method static Builder|Media newModelQuery()
 * @method static Builder|Media newQuery()
 * @method static Builder|Media query()
 * @method static Builder|Media whereAnimalId($value)
 * @method static Builder|Media whereCreatedAt($value)
 * @method static Builder|Media whereFileName($value)
 * @method static Builder|Media whereId($value)
 * @method static Builder|Media wherePrimary($value)
 * @method static Builder|Media whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'entity_type',
        'file_name',
        'primary',
    ];

    public function entity(): MorphTo
    {
        return $this->morphTo();
    }
}
