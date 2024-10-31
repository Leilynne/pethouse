<?php

namespace App\Repositories;

use App\Enums\AnimalHealth;
use App\Enums\AnimalSex;
use App\Enums\AnimalStatus;
use App\Enums\AnimalType;
use App\Exceptions\AnimalNotFoundException;
use App\Models\Animal;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AnimalRepository implements AnimalRepositoryInterface
{
    public function getAllAnimals(int $page = 1, array $filters = []): LengthAwarePaginator
    {
        $builder = Animal::with(['preview', 'color', 'tags']);

        if (isset($filters['color'])) {
            $builder->where('color_id', $filters['color']);
        }
        if (isset($filters['type'])) {
            $builder->where('type', $filters['type']);
        }
        if (isset($filters['sex'])) {
            $builder->where('sex', $filters['sex']);
        }
        if (isset($filters['health'])) {
            $builder->where('health', $filters['health']);
        }
        if (isset($filters['status'])) {
            $builder->whereIn('animal_status', $filters['status']);
        }
        if (isset($filters['birthdayBefore'])) {
            $builder->where('birthday', '<=', $filters['birthdayBefore']);
        }
        if (isset($filters['birthdayAfter'])) {
            $builder->where('birthday', '>=', $filters['birthdayAfter']);
        }
        foreach ($filters['tags'] ?? [] as $tag) {
            $builder->whereRelation('tags', 'tags.id', '=', $tag);
        }

        return $builder->paginate(6, ['*'], 'page', $page);
    }

    /**
     * @throws AnimalNotFoundException
     */
    public function getAnimalById(int $id, array $relations = []): Animal
    {
        return Animal::with($relations)->where(['id' => $id])->first() ?? throw new AnimalNotFoundException();
    }

    /**
     * @inheritDoc
     */
    public function getAnimalsByType(AnimalType $type): Collection
    {
        return Animal::where(['type' => $type])->get();
    }

    /**
     * @inheritDoc
     */
    public function getAnimalsBySex(AnimalSex $sex): Collection
    {
        return Animal::where(['sex' => $sex])->get();
    }

    /**
     * @inheritDoc
     */
    public function getAnimalsByHealth(AnimalHealth $health): Collection
    {
        return Animal::where(['health' => $health])->get();
    }

    /**
     * @inheritDoc
     */
    public function getAnimalsByStatus(AnimalStatus $status): Collection
    {
        return Animal::where(['status' => $status])->get();
    }

    /**
     * @inheritDoc
     */
    public function getAnimalsByUserId(int $userId): Collection
    {
        return Animal::where(['user_id' => $userId])->get();
    }
}
