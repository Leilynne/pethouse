<?php

namespace App\Repositories;

use App\Enums\AdoptionStatus;
use App\Models\AdoptionRequest;
use App\Repositories\AdoptionRequestRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class AdoptionRequestRepository implements AdoptionRequestRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function getAllAdoptionRequests(): Collection
    {
        return AdoptionRequest::all();
    }

    public function getAdoptionRequestById(int $id): AdoptionRequest
    {
        return AdoptionRequest::where(['id' => $id])->first();
    }

    /**
     * @inheritDoc
     */
    public function getAdoptionRequestsByUserId(int $userId): Collection
    {
        return AdoptionRequest::where(['user_id' => $userId])->get();
    }

    /**
     * @inheritDoc
     */
    public function getAdoptionRequestsByAnimalId(int $animalId): Collection
    {
        return AdoptionRequest::where(['animal_id' => $animalId])->get();
    }

    /**
     * @inheritDoc
     */
    public function getAdoptionRequestsByStatus(AdoptionStatus $status): Collection
    {
        return AdoptionRequest::where(['status' => $status])->get();
    }
}
