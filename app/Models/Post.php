<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Post|null $post
 * @property-read Media|null $preview
 * @property-read Collection<int, Media> $album
 * @property-read Collection<int, Media> $photos
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'title',
    ];

    public function preview(): MorphOne
    {
        return $this->morphOne(Media::class, 'entity')->where(['primary' => true]);
    }

    public function photos(): MorphMany
    {
        return $this->morphMany(Media::class, 'entity')->where(['primary' => false]);
    }

    public function album(): MorphMany
    {
        return $this->morphMany(Media::class, 'entity');
    }
}
