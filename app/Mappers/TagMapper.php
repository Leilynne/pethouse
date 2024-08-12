<?php

declare(strict_types=1);

namespace App\Mappers;

use App\DTO\TagDTO;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

readonly class TagMapper
{
    public static function mapModelToDTO(Tag $entity): TagDTO
    {
        return new TagDTO(
            $entity->id,
            $entity->name,
        );
    }

    /**
     * @param Collection<int, Tag> $entities
     * @return TagDTO[]
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
