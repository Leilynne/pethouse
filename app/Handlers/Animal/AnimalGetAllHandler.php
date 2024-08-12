<?php

declare(strict_types=1);

namespace App\Handlers\Animal;

use App\DTO\AnimalDTO;
use App\Mappers\AnimalMapper;
use App\Repositories\AnimalRepositoryInterface;

readonly class AnimalGetAllHandler
{
    public function __construct(
        private AnimalRepositoryInterface $animalRepository
    ) {
    }

    /**
     * @return AnimalDTO[]
     */
    public function handle(): array
    {
        return AnimalMapper::mapModelsToDTOArray($this->animalRepository->getAllAnimals());
    }
}
