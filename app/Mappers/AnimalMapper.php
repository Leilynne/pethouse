<?php

declare(strict_types=1);

namespace App\Mappers;

use App\DTO\AnimalDTO;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Collection;

readonly class AnimalMapper
{
    public static function mapModelToDTO(Animal $entity): AnimalDTO
    {
        if ($entity->relationLoaded('photos')) {
            $photos = $entity->photos;
        } else {
            $photos = [];
        }


        if (
            $entity->relationLoaded('owner')
            && null !== $entity->owner
        ) {
            $user = UserMapper::mapModelToDTO($entity->owner);
        } else {
            $user = null;
        }


        if ($entity->relationLoaded('curators')) {
            $curators = $entity->curators;
        } else {
            $curators = [];
        }

        return new AnimalDTO(
            $entity->id,
            $entity->name,
            $entity->type,
            $entity->health,
            $entity->description,
            $entity->animal_status,
            $entity->sex,
            ColorMapper::mapModelToDTO($entity->color),
            $entity->birthday,
            MediaMapper::mapModelToDTO($entity->preview),
            TagMapper::mapModelsToDTOArray($entity->tags),
            MediaMapper::mapModelsToDTOArray($photos),
            $user,
            UserMapper::mapModelsToDTOArray($curators),
            $entity->comment,
        );
    }

    /**
     * @param Collection<int, Animal> $entities
     * @return AnimalDTO[]
     */
    public static function mapModelsToDTOArray(Collection $entities): array
    {
        $result = [];
        foreach ($entities as $entity) {
            $result[] = self::mapModelToDTO($entity);
        }

        return $result;
    }
}
