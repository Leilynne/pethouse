<?php

declare(strict_types=1);

namespace App\Enums;

enum AnimalSex: string
{
    case Male = 'male';
    case Female = 'female';

    public function label(): string
    {
        return match ($this) {
            self::Male => 'Мальчик',
            self::Female => 'Девочка',
        };
    }
}
