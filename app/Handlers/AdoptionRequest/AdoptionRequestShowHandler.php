<?php

declare(strict_types=1);

namespace App\Handlers\AdoptionRequest;

use App\DTO\AdoptionRequestDTO;
use App\Mappers\AdoptionRequestMapper;
use App\Repositories\AdoptionRequestRepositoryInterface;

readonly class AdoptionRequestShowHandler
{

    public function __construct(
        private AdoptionRequestRepositoryInterface $adoptionRequestRepository,
    ){
    }

     public function handle(int $adoptionRequestId): AdoptionRequestDTO
     {
         return AdoptionRequestMapper::mapModelToDTO(
             $this->adoptionRequestRepository->getAdoptionRequestById($adoptionRequestId)
         );
    }

}
