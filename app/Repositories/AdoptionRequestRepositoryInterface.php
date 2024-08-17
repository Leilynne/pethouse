<?php

namespace App\Repositories;

use App\Enums\AdoptionStatus;
use App\Models\AdoptionRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface AdoptionRequestRepositoryInterface
{
    /**
     * @param int $page
     * @param array $filters
     * @param string[] $relations
     * @return LengthAwarePaginator
     */
    public function getAllAdoptionRequests(int $page = 1, array $filters = [], array $relations = []): LengthAwarePaginator;

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
