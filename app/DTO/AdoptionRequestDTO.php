<?php

namespace App\DTO;

use App\Enums\AdoptionStatus;

class AdoptionRequestDTO
{
    public function __construct(
        public int $id,
        public UserDTO $user,
        public AnimalDTO $animal,
        public AdoptionStatus $status,
    ) {
    }
}
