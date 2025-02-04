<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\AdoptionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int $animal_id
 * @property mixed $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Animal $animal
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|AdoptionRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdoptionRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdoptionRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdoptionRequest whereAnimalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdoptionRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdoptionRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdoptionRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdoptionRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdoptionRequest whereUserId($value)
 * @mixin \Eloquent
 */
class AdoptionRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'animal_id',
        'user_id',

    ];

    public function casts(): array
    {
        return [
            'status' => AdoptionStatus::class,
        ];
    }

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
