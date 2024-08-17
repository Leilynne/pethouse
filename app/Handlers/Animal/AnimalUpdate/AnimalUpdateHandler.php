<?php

declare(strict_types=1);

namespace App\Handlers\Animal\AnimalUpdate;

use App\DTO\AnimalDTO;
use App\Mappers\AnimalMapper;
use App\Repositories\AnimalRepositoryInterface;
use Illuminate\Contracts\Filesystem\Filesystem;
use Symfony\Component\Uid\Ulid;

readonly class AnimalUpdateHandler
{
    public function __construct(
        private AnimalRepositoryInterface $animalRepository,
        private Filesystem $filesystem,
    ) {
    }

    /**
     * @param AnimalUpdateCommand $command
     * @return AnimalDTO
     */
    public function handle(AnimalUpdateCommand $command): AnimalDTO
    {
        $animal = $this->animalRepository->getAnimalById($command->animalId);
        $animal->update([
            'name' => $command->name,
            'birthday' => $command->birthday,
            'sex' => $command->sex,
            'type' => $command->type,
            'health' => $command->health,
            'animal_status' => $command->status,
            'color_id' => $command->colorId,
            'user_id' => $command->userId,
            'comment' => $command->comment,
            'description' => $command->description,
        ]);
        $animal->tags()->attach($command->tags ?? []);

        if (isset($command->preview)) {

            $ulid = new Ulid();
            $filename = $ulid->toString() . '.' . $command->preview->extension();
            $this->filesystem->putFileAs('animals', $command->preview, $filename);

            $this->filesystem->delete('animals/' . $animal->preview->file_name);

            $animal->preview->update([
                'file_name' => $filename,
            ]);
        }

        return AnimalMapper::mapModelToDTO($animal);
    }
}
