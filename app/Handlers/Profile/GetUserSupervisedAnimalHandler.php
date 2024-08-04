<?php

declare(strict_types=1);

namespace App\Handlers\Profile;

use App\Models\Animal;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class GetUserSupervisedAnimalHandler
{
    /**
     * @return Collection<int, Animal>
     */
    public function handle(): Collection
    {
       return  Auth::user()->supervisedAnimals;
    }

}
