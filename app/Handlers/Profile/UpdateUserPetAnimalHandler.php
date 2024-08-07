<?php

declare(strict_types=1);

namespace App\Handlers\Profile;

use App\Exceptions\AnimalNotFoundException;
use App\Exceptions\InvalidPetUpdateRequestException;
use App\Handlers\Animal\AnimalUpdateHandler;
use App\Models\Animal;
use App\Repositories\AnimalRepository;
use Illuminate\Support\Facades\Auth;

readonly class UpdateUserPetAnimalHandler
{
    public function __construct(
        private AnimalUpdateHandler $animalUpdateHandler,
        private AnimalRepository $animalRepository,
    ){
    }

    /**
     * @throws AnimalNotFoundException
     * @throws InvalidPetUpdateRequestException
     */
    public function handle(array $data, int $animalId): Animal
    {
        $animal = $this->animalRepository->getAnimalById($animalId);

        if (Auth::user()->id != $animal->user_id){
            throw new InvalidPetUpdateRequestException();
        }
        return $this->animalUpdateHandler->handle($data, $animalId);
    }

}
