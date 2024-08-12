<?php

namespace App\Repositories;

use App\Enums\AnimalHealth;
use App\Enums\AnimalSex;
use App\Enums\AnimalStatus;
use App\Enums\AnimalType;
use App\Exceptions\AnimalNotFoundException;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Collection;

class AnimalRepository implements AnimalRepositoryInterface
{
    public function getAllAnimals(): Collection
    {
        return Animal::all();
    }

    /**
     * @throws AnimalNotFoundException
     */
    public function getAnimalById(int $id, array $relations = []): Animal
    {
        return Animal::with($relations)->where(['id'=> $id])->first() ?? throw new AnimalNotFoundException();
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
        return Animal::where(['user_id'=> $userId])->get();
    }
}
