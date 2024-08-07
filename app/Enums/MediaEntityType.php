<?php

declare(strict_types=1);

namespace App\Enums;

use App\Models\Animal;
use App\Models\Post;

enum MediaEntityType: string
{
    case Animal = 'animals';
    case Post = 'posts';

    public function className(): string
    {
        return match ($this) {
            self::Animal => Animal::class,
            self::Post => Post::class,
        };
    }
}
