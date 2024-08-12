<?php

declare(strict_types=1);

namespace App\Handlers\User\UserUpdate;

use App\Models\User;

readonly class UserUpdateCommand
{
    public function __construct(
        public User $user,
        public string $name,
        public string $email,
        public string $phone,
    ) {
    }
}
