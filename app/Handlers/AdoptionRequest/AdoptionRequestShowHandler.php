<?php

declare(strict_types=1);

namespace App\Handlers\AdoptionRequest;

use App\Models\AdoptionRequest;
use App\Repositories\AdoptionRequestRepository;
 readonly class AdoptionRequestShowHandler
{

    public function __construct(
        private AdoptionRequestRepository $adoptionRequestRepository,
    ){
    }

     public function handle(int $adoptionRequestId): AdoptionRequest
     {
         return $this->adoptionRequestRepository->getAdoptionRequestById($adoptionRequestId);
    }

}
