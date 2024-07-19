<?php

declare(strict_types=1);

namespace App\Enums;

enum AnimalHealth: string
{
    case Great = 'great';
    case Normal = 'normal';
    case Poor = 'poor';

    public function label(): string
    {
        return match ($this) {
            self::Great => 'Отличное',
            self::Normal => 'Нормальное',
            self::Poor => 'Тяжелое',
        };
    }
}
