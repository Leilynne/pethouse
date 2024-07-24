<?php

declare(strict_types=1);

namespace App\Handlers\Animal;

use App\Exceptions\AnimalNotFoundException;
use App\Models\Animal;
use App\Repositories\AnimalRepository;

readonly class AnimalShowHandler
{

    public function __construct(
        private AnimalRepository $repository
    ){
    }

    /**
     * @throws AnimalNotFoundException
     */
    public function handle(int $animalId): Animal
    {
        return $this->repository->getAnimalById($animalId);
    }
}
