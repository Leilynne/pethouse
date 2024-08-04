<?php

declare(strict_types=1);

namespace App\Handlers\AdoptionRequest;

use App\Repositories\AdoptionRequestRepository;
use Illuminate\Database\Eloquent\Collection;

readonly class AdoptionRequestGetAllHandler
{

    public function __construct(
        private AdoptionRequestRepository $adoptionRequestRepository,
    ){
    }

    public function handle(): Collection
    {
        return $this->adoptionRequestRepository->getAllAdoptionRequests();

    }

}
