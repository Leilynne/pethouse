<?php

declare(strict_types=1);

namespace App\Handlers\AdoptionRequest\AdoptionRequestCreate;

use App\DTO\AdoptionRequestDTO;
use App\Enums\AdoptionStatus;
use App\Mappers\AdoptionRequestMapper;
use App\Models\AdoptionRequest;

readonly class AdoptionRequestCreateHandler
{
    public function handle(AdoptionRequestCreateCommand $command): AdoptionRequestDTO
    {
        /**
         * @var AdoptionRequest $adoptionRequest
         */
        $adoptionRequest = AdoptionRequest::create([
            'user_id' => $command->userId,
            'animal_id' => $command->animalId,
            'status' => AdoptionStatus::New,
        ]);

        return AdoptionRequestMapper::mapModelToDTO($adoptionRequest);
    }
}
