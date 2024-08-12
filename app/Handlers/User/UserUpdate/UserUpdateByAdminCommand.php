<?php

declare(strict_types=1);

namespace App\Handlers\User\UserUpdate;

use App\Models\User;

readonly class UserUpdateByAdminCommand
{
    public function __construct(
        public int $userId,
        public string $name,
        public string $email,
        public string $phone,
        public string $text,
    ) {
    }
}
