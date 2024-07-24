<?php

declare(strict_types=1);

namespace App\Handlers\Animal;

use App\Models\Animal;
use App\Repositories\AnimalRepository;
use Illuminate\Database\Eloquent\Collection;

readonly class AnimalGetAllHandler
{
    public function __construct(
        private AnimalRepository $animalRepository
    ) {
    }

    /**
     * @return  Collection<int, Animal>
     */
    public function handle(): Collection
    {
        return $this->animalRepository->getAllAnimals();
    }
}
