<?php

declare(strict_types = 1);

namespace App\Handlers\Profile;

use App\Enums\AnimalStatus;
use App\Handlers\Animal\AnimalCreateHandler;
use App\Models\Animal;
use Illuminate\Support\Facades\Auth;

readonly class CreateUserPetAnimalHandler
{

    public function __construct(
        private AnimalCreateHandler $animalCreateHandler,
    ){
    }

    public function handle(array $data): Animal
    {
        $data['user_id'] = Auth::id();
        $data['animal_status'] = AnimalStatus::Household;

        return $this->animalCreateHandler->handle($data);
    }
}
