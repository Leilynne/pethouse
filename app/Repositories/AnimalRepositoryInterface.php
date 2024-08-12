<?php

namespace App\Repositories;

use App\Enums\AnimalHealth;
use App\Enums\AnimalSex;
use App\Enums\AnimalStatus;
use App\Enums\AnimalType;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Collection;

interface AnimalRepositoryInterface
{
    /**
     * @return Collection<int, Animal>
     */
    public function getAllAnimals(): Collection;


    public function getAnimalById(int $id): Animal;


    /**
     * @param AnimalType $type
     * @return Collection<int, Animal>
     */
    public function getAnimalsByType(AnimalType $type): Collection;


    /**
     * @param AnimalSex $sex
     * @return Collection<int, Animal>
     */
    public function getAnimalsBySex(AnimalSex $sex): Collection;


    /**
     * @param AnimalHealth $health
     * @return Collection<int, Animal>
     */
    public function getAnimalsByHealth(AnimalHealth $health): Collection;


    /**
     * @param AnimalStatus $status
     * @return Collection<int, Animal>
     */
    public function getAnimalsByStatus(AnimalStatus $status): Collection;


    /**
     * @param int $userId
     * @return Collection<int, Animal>
     */
    public function getAnimalsByUserId(int $userId): Collection;
}
