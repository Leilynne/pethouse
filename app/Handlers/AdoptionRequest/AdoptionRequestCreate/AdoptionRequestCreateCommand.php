<?php

namespace App\Handlers\AdoptionRequest\AdoptionRequestCreate;

readonly class AdoptionRequestCreateCommand
{
    public function __construct(
        public int $userId,
        public int $animalId,
    ) {
    }
}
