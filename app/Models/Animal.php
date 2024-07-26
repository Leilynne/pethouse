<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\AnimalHealth;
use App\Enums\AnimalSex;
use App\Enums\AnimalStatus;
use App\Enums\AnimalType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $birthday
 * @property mixed $type
 * @property mixed $health
 * @property string $description
 * @property string $animal_status
 * @property int $user_id
 * @property string $comment
 * @property mixed $sex
 * @property int $color_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Animal newModelQuery()
 * @method static Builder|Animal newQuery()
 * @method static Builder|Animal query()
 * @method static Builder|Animal whereAge($value)
 * @method static Builder|Animal whereAnimalStatus($value)
 * @method static Builder|Animal whereColorId($value)
 * @method static Builder|Animal whereComment($value)
 * @method static Builder|Animal whereCreatedAt($value)
 * @method static Builder|Animal whereDescription($value)
 * @method static Builder|Animal whereHealth($value)
 * @method static Builder|Animal whereId($value)
 * @method static Builder|Animal whereName($value)
 * @method static Builder|Animal whereSex($value)
 * @method static Builder|Animal whereType($value)
 * @method static Builder|Animal whereUpdatedAt($value)
 * @method static Builder|Animal whereUserId($value)
 * @property-read Color|null $color
 * @property-read Media|null $preview
 * @property-read Collection<int, Tag> $tags
 * @property-read Collection<int, Media> $album
 * @property-read int|null $tags_count
 * @property-read Collection<int, User> $curators
 * @property-read Collection<int, Media> $photos
 * @property-read int|null $users_count
 * @method static Builder|Animal whereBirthday($value)
 * @mixin \Eloquent
 */
class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'type',
        'birthday',
        'health',
        'description',
        'animal_status',
        'user_id',
        'sex',
        'color_id',
        'comment'
    ];

    public function casts(): array
    {
        return [
            'type' => AnimalType::class,
            'health' => AnimalHealth::class,
            'animal_status' => AnimalStatus::class,
            'sex' => AnimalSex::class,
            'birthday' => 'date',
        ];
    }

    public function curators(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function preview(): HasOne
    {
        return $this->hasOne(Media::class)->where(['primary' => true]);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Media::class)->where(['primary' => false]);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function album(): HasMany
    {
        return $this->hasMany(Media::class);
    }
}
