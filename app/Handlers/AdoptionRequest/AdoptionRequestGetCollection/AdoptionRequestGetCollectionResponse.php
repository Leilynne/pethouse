<?php

namespace App\Handlers\AdoptionRequest\AdoptionRequestGetCollection;

use App\DTO\AdoptionRequestDTO;

readonly class AdoptionRequestGetCollectionResponse
{
    /**
     * @param AdoptionRequestDTO[] $adoptionRequests
     */
    public function __construct(
        public array $adoptionRequests,
        public int $total,
        public int $lastPage,
    ) {
    }
}
