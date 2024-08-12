<?php

declare(strict_types=1);

namespace App\Handlers\Animal\AnimalCreate;

use App\DTO\AnimalDTO;
use App\Enums\MediaEntityType;
use App\Mappers\AnimalMapper;
use App\Models\Animal;
use App\Models\Media;
use Symfony\Component\Uid\Ulid;

readonly class AnimalCreateHandler
{
    /**
     * @param AnimalCreateCommand $command
     * @return AnimalDTO
     */
    public function handle(AnimalCreateCommand $command): AnimalDTO
    {
        /**
         * @var Animal $animal
         */
        $animal = Animal::create([
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

        $ulid = new Ulid();
        $filename = $ulid->toString() . '.' . $command->preview->extension();
        \Storage::disk('public')->putFileAs('animals', $command->preview, $filename);

        Media::create([
            'file_name' => $filename,
            'entity_id' => $animal->id,
            'entity_type' => MediaEntityType::Animal->className(),
            'primary' => true,
        ]);

        return AnimalMapper::mapModelToDTO($animal);
    }
}
