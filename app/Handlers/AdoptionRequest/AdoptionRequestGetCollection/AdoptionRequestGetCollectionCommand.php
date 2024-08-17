<?php

namespace App\Handlers\AdoptionRequest\AdoptionRequestGetCollection;

use App\Enums\AdoptionStatus;

readonly class AdoptionRequestGetCollectionCommand
{
    public function __construct(
        public int $page,
        public ?AdoptionStatus $status,
    ) {
    }
}
