<?php

declare(strict_types=1);

namespace App\Handlers\Animal;

use App\Exceptions\AnimalNotFoundException;
use App\Repositories\AnimalRepository;
use Illuminate\Support\Facades\Storage;

readonly class AnimalDeleteHandler
{
    public function __construct(
        private AnimalRepository $animalRepository
    ) {
    }

    /**
     * @throws AnimalNotFoundException
     */
    public function handle(int $animalId): void
    {
        $animal = $this->animalRepository->getAnimalById($animalId);
        $album = $animal->album;
        $animal->album()->delete();
        $animal->delete();

        foreach ($album as $item) {
            Storage::disk('public')->delete('animals/' . $item->file_name);
        }
    }
}
