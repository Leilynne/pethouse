<?php

declare(strict_types=1);

namespace App\Handlers\Profile;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Support\Collection;

class GetAllUserPetAnimalsHandler
{
    /**
     * @param User $user
     * @return Collection<int, Animal>
     */
    public function handle(User $user): Collection
    {
        return $user->animals;
    }
}
