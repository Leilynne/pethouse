<?php

declare(strict_types=1);

namespace App\Handlers\Animal;

use App\Exceptions\AnimalNotFoundException;
use App\Repositories\AnimalRepositoryInterface;
use Illuminate\Contracts\Filesystem\Filesystem;

readonly class AnimalDeleteHandler
{
    public function __construct(
        private AnimalRepositoryInterface $animalRepository,
        private Filesystem $filesystem,
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
            $this->filesystem->delete('animals/' . $item->file_name);
        }
    }
}
