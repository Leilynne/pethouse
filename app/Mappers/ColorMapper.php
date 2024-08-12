<?php

declare(strict_types=1);

namespace App\Mappers;

use App\DTO\ColorDTO;
use App\Models\Color;
use Illuminate\Database\Eloquent\Collection;

readonly class ColorMapper
{
    public static function mapModelToDTO(Color $entity): ColorDTO
    {
        return new ColorDTO(
            $entity->id,
            $entity->name,
        );
    }

    /**
     * @param Collection<int, Color> $entities
     * @return ColorDTO[]
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
