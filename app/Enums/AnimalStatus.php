<?php

declare(strict_types=1);

namespace App\Enums;

enum AnimalStatus: string
{
    case Adopted = 'adopted';
    case Awaiting = 'awaiting';
    case LookingHome = 'looking-home';
    case Household = 'household';

    public function label(): string
    {
        return match ($this) {
            self::Adopted => 'Нашли дом',
            self::Awaiting => 'В процессе передачи домой',
            self::LookingHome => 'Ищем дом',
            self::Household => 'Домашний',
        };
    }



}
