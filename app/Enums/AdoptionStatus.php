<?php

declare(strict_types=1);

namespace App\Enums;

enum AdoptionStatus: string
{
    case New = 'new';
    case InProgress = 'in-progress';
    case Completed = 'completed';
    case Cancelled = 'cancelled';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::New => 'Новый',
            self::InProgress => 'В процессе',
            self::Completed => 'Завершен',
            self::Cancelled => 'Отменен',
            self::Rejected => 'Отклонен',
        };
    }
}
