<?php

declare(strict_types=1);

namespace App\Handlers\Profile;

use App\DTO\AnimalDTO;
use App\Mappers\AnimalMapper;
use App\Models\User;

class GetUserSupervisedAnimalHandler
{
    /**
     * @return AnimalDTO[]
     */
    public function handle(User $user): array
    {
       return  AnimalMapper::mapModelsToDTOArray($user->supervisedAnimals()->with(['preview', 'tags', 'color'])->get());
    }

}
