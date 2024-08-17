<?php

declare(strict_types=1);

namespace App\Enums;

enum AnimalAge: string
{
    case Young = 'young';
    case Adult = 'adult';
    case Old = 'old';

    public function getFromModifyString(): ?string
    {
        return match ($this) {
            self::Old => null,
            self::Adult => '-3 year',
            self::Young => '-1 year',
        };
    }

    public function getToModifyString(): ?string
    {
        return match ($this) {
            self::Old => '-3 year',
            self::Adult => '-1 year',
            self::Young => null,
        };
    }
}
