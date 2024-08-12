<?php

declare(strict_types=1);

namespace App\Mappers;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

readonly class UserMapper
{
    public static function mapModelToDTO(User $entity): UserDTO
    {
        return new UserDTO(
            $entity->id,
            $entity->name,
            $entity->email,
            $entity->role,
            $entity->phone,
            $entity->text,
        );
    }

    /**
     * @param Collection<int, User>|User[] $entities
     * @return UserDTO[]
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
