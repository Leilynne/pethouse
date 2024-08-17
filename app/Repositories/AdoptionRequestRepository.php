<?php

namespace App\Repositories;

use App\Enums\AdoptionStatus;
use App\Models\AdoptionRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AdoptionRequestRepository implements AdoptionRequestRepositoryInterface
{
    public function getAllAdoptionRequests(int $page = 1, array $filters = [], array $relations = []): LengthAwarePaginator
    {
        $builder = AdoptionRequest::with($relations)->orderBy('created_at', 'desc');

        if (isset($filters['status'])) {
            $builder->where('status', $filters['status']);
        }

        return $builder->paginate(10, ['*'], 'page', $page);
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
