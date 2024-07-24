<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\AdoptionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $animal_id
 * @property mixed $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Animal|null $animals
 * @property-read \App\Models\User|null $users
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
        'status'
    ];

    public function casts(): array
    {
        return [
            'status' => AdoptionStatus::class,
        ];
    }

    public function animals(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
