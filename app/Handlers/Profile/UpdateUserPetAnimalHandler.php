<?php

declare(strict_types=1);

namespace App\Handlers\Profile;

use App\Exceptions\AnimalNotFoundException;
use App\Handlers\Animal\AnimalUpdateHandler;
use App\Models\Animal;

class UpdateUserPetAnimalHandler
{
    public function __construct(
        private AnimalUpdateHandler $animalUpdateHandler,
    ){
    }

    /**
     * @throws AnimalNotFoundException
     */
    public function handle(array $data, int $animalId): Animal
    {
        return $this->animalUpdateHandler->handle($data, $animalId);
    }

}
