<?php

declare(strict_types=1);

namespace App\Handlers\Animal;

use App\Exceptions\AnimalNotFoundException;
use App\Repositories\AnimalRepository;

readonly class AnimalAddCuratorHandler
{

    public function __construct(
        private  AnimalRepository $animalRepository,
    ){
    }

    /**
     * @throws AnimalNotFoundException
     */
    public function handle(int $animalId, int $userId): void
    {
        $animal = $this->animalRepository->getAnimalById($animalId);

        if (false === $animal->curators()->where('user_id', $userId)->exists()) {
            $animal->curators()->attach($userId);
        }
    }
}
