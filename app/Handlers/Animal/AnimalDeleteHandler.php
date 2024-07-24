<?php

declare(strict_types=1);

namespace App\Handlers\Animal;

use App\Repositories\AnimalRepository;

readonly class AnimalDeleteHandler
{
    public function __construct(
        private AnimalRepository $animalRepository
    ) {
    }

    public function handle(int $animalId): void
    {
        $animal = $this->animalRepository->getAnimalById($animalId);
        $animal->delete();
    }
}
