<?php

declare(strict_types=1);

namespace App\Mappers;

use App\DTO\PostDTO;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

readonly class PostMapper
{
    public static function mapModelToDTO(Post $entity): PostDTO
    {
        if ($entity->relationLoaded('photos')) {
            $photos = MediaMapper::mapModelsToDTOArray($entity->photos);
        } else {
            $photos = [];
        }

        return new PostDTO(
            $entity->id,
            $entity->description,
            $entity->title,
            MediaMapper::mapModelToDTO($entity->preview),
            $photos,
        );
    }

    /**
     * @param Collection<int, Post>|Post[] $entities
     * @return PostDTO[]
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
