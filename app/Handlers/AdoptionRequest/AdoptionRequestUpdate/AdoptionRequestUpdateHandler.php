<?php

declare(strict_types=1);

namespace App\Handlers\AdoptionRequest\AdoptionRequestUpdate;

use App\DTO\AdoptionRequestDTO;
use App\Mappers\AdoptionRequestMapper;
use App\Repositories\AdoptionRequestRepositoryInterface;

readonly class AdoptionRequestUpdateHandler
{

    public function __construct(
        private AdoptionRequestRepositoryInterface $adoptionRequestRepository,
    ){
    }

    public function handle(AdoptionRequestUpdateCommand $command): AdoptionRequestDTO
    {
        $adoptionRequest =  $this->adoptionRequestRepository->getAdoptionRequestById($command->id);
        $adoptionRequest->update([
            'status' => $command->status,
        ]);

        return AdoptionRequestMapper::mapModelToDTO($adoptionRequest);
    }

}
