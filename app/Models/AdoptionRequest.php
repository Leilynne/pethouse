<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\AdoptionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
