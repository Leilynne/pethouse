<?php

namespace App\Handlers\AdoptionRequest\AdoptionRequestUpdate;

use App\Enums\AdoptionStatus;

readonly class AdoptionRequestUpdateCommand
{
    public function __construct(
        public int $id,
        public AdoptionStatus $status,
    ) {
    }
}
