<?php

declare(strict_types=1);

namespace App\Handlers\AdoptionRequest;

use App\DTO\AdoptionRequestDTO;
use App\Mappers\AdoptionRequestMapper;
use App\Repositories\AdoptionRequestRepositoryInterface;

readonly class AdoptionRequestGetAllHandler
{

    public function __construct(
        private AdoptionRequestRepositoryInterface $adoptionRequestRepository,
    ){
    }

    /**
     * @return AdoptionRequestDTO[]
     */
    public function handle(): array
    {
        return AdoptionRequestMapper::mapModelsToDTOArray(
            $this->adoptionRequestRepository->getAllAdoptionRequests(['animal', 'user'])
        );
    }
}
