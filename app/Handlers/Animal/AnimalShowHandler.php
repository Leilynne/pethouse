<?php

declare(strict_types=1);

namespace App\Handlers\Animal;

use App\DTO\AnimalDTO;
use App\Exceptions\AnimalNotFoundException;
use App\Mappers\AnimalMapper;
use App\Repositories\AnimalRepositoryInterface;

readonly class AnimalShowHandler
{

    public function __construct(
        private AnimalRepositoryInterface $repository
    ){
    }

    /**
     * @throws AnimalNotFoundException
     */
    public function handle(int $animalId): AnimalDTO
    {
        return AnimalMapper::mapModelToDTO($this->repository->getAnimalById($animalId, ['photos', 'owner', 'curators']));
    }
}
