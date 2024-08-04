<?php

declare(strict_types=1);

namespace App\Handlers\AdoptionRequest;

use App\Models\AdoptionRequest;

class AdoptionRequestCreateHandler
{
    /**
     * @param array<string, mixed> $data
     * @return AdoptionRequest
     */
    public function handle(array $data): AdoptionRequest
    {
        /**
         * @var AdoptionRequest $adoptionRequest
         */
       $adoptionRequest = AdoptionRequest::create($data);

        return $adoptionRequest;
    }
}
