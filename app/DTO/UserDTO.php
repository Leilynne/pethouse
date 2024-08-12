<?php

namespace App\DTO;

use App\Enums\UserRole;

class UserDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public UserRole $role,
        public string $phone,
        public ?string $text,
    ) {
    }
}
