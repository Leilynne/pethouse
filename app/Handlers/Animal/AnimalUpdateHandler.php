<?php

declare(strict_types=1);

namespace App\Handlers\Animal;

use App\Exceptions\AnimalNotFoundException;
use App\Models\Animal;
use App\Repositories\AnimalRepository;
use Illuminate\Http\UploadedFile;
use Symfony\Component\Uid\Ulid;

readonly class AnimalUpdateHandler
{
    public function __construct(
        private AnimalRepository $animalRepository
    ) {
    }

    /**
     * @param array<string, mixed> $data
     * @throws AnimalNotFoundException
     */
    public function handle(array $data, int $animalId): Animal
    {
        $animal = $this->animalRepository->getAnimalById($animalId);
        $animal->update($data);
        $animal->tags()->sync($data['tags']);

        if (isset($data['preview'])) {
            /* @var UploadedFile $file */
            $file = $data['preview'];

            $ulid = new Ulid();
            $filename = $ulid->toString() . '.' . $file->extension();
            $file->storeAs('animals', $filename);

            \Storage::delete('animals/' . $animal->preview->file_name);

            $animal->preview->update([
                'file_name' => $filename,
            ]);
        }

        return $animal;
    }
}
