<?php

declare(strict_types=1);

namespace App\Mappers;

use App\DTO\AdoptionRequestDTO;
use App\Models\AdoptionRequest;
use Illuminate\Database\Eloquent\Collection;

readonly class AdoptionRequestMapper
{
    public static function mapModelToDTO(AdoptionRequest $entity): AdoptionRequestDTO
    {
        return new AdoptionRequestDTO(
            $entity->id,
            UserMapper::mapModelToDTO($entity->user),
            AnimalMapper::mapModelToDTO($entity->animal),
            $entity->status,
        );
    }

    /**
     * @param Collection<int, AdoptionRequest> $entities
     * @return AdoptionRequestDTO[]
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
