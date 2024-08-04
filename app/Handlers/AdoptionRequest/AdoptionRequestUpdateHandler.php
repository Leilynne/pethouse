<?php

declare(strict_types=1);

namespace App\Handlers\AdoptionRequest;

use App\Models\AdoptionRequest;
use App\Repositories\AdoptionRequestRepository;

readonly class AdoptionRequestUpdateHandler
{

    public function __construct(
        private AdoptionRequestRepository $adoptionRequestRepository,
    ){
    }

    public function handle(array $data, int $adoptionId): AdoptionRequest
    {
        $adoptionRequest =  $this->adoptionRequestRepository->getAdoptionRequestById($adoptionId);
        $adoptionRequest->update($data);

        return $adoptionRequest;
    }

}
