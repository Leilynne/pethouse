<?php

declare(strict_types=1);

namespace App\Mappers;

use App\DTO\MediaDTO;
use App\Models\Media;
use Illuminate\Database\Eloquent\Collection;

readonly class MediaMapper
{
    public static function mapModelToDTO(Media $entity): MediaDTO
    {
        return new MediaDTO(
            $entity->id,
            $entity->file_name,
            $entity->primary,
        );
    }

    /**
     * @param Collection<int, Media>|Media[] $entities
     * @return MediaDTO[]
     */
    public static function mapModelsToDTOArray(Collection|array $entities): array
    {
        $result = [];
        foreach ($entities as $entity) {
            $result[] = self::mapModelToDTO($entity);
        }

        return $result;
    }
}
