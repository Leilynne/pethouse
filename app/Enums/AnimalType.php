<?php

declare(strict_types=1);

namespace App\Enums;

enum AnimalType: string
{
    case Cat = 'cat';
    case Dog = 'dog';

    public function label(): string
    {
        return match ($this) {
            self::Cat => 'Котик',
            self::Dog => 'Пёсик',
        };
    }
}
