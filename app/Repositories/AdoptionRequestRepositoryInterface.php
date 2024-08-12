<?php

namespace App\Repositories;

use App\Enums\AdoptionStatus;
use App\Models\AdoptionRequest;
use Illuminate\Database\Eloquent\Collection;

interface AdoptionRequestRepositoryInterface
{
    /**
     * @param string[] $relations
     * @return Collection<int, AdoptionRequest>
     */
    public function getAllAdoptionRequests(array $relations = []): Collection;

    public function getAdoptionRequestById(int $id): AdoptionRequest;

    /**
     * @param int $userId
     * @return Collection<int, AdoptionRequest>
     */
    public function getAdoptionRequestsByUserId(int $userId): Collection;

    /**
     * @param int $animalId
     * @return Collection<int, AdoptionRequest>
     */
    public function getAdoptionRequestsByAnimalId(int $animalId): Collection;

    /**
     * @param AdoptionStatus $status
     * @return Collection<int, AdoptionRequest>
     */
    public function getAdoptionRequestsByStatus(AdoptionStatus $status): Collection;
}
