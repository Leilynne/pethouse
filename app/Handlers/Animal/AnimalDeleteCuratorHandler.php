<?php

declare(strict_types=1);

namespace App\Handlers\Animal;

use App\Exceptions\AnimalNotFoundException;
use App\Repositories\AnimalRepositoryInterface;

readonly class AnimalDeleteCuratorHandler
{
    public function __construct(
        private AnimalRepositoryInterface $animalRepository,
    ){
    }

    /**
     * @throws AnimalNotFoundException
     */
    public function handle(int $animalId, int $userId): void
    {
        $animal = $this->animalRepository->getAnimalById($animalId);
        if (true === $animal->curators()->where('user_id', $userId)->exists()) {
            $animal->curators()->detach($userId);
        }
    }
}
