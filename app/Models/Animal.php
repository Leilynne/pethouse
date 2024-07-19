<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\AnimalHealth;
use App\Enums\AnimalSex;
use App\Enums\AnimalStatus;
use App\Enums\AnimalType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'type',
        'health',
        'description',
        'animal-status',
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
            'animal-status' => AnimalStatus::class,
            'sex' => AnimalSex::class,
        ];
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function colors(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

}
