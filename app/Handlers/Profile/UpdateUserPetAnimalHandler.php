<?php

declare(strict_types=1);

namespace App\Handlers\Profile;

use App\DTO\AnimalDTO;
use App\Exceptions\AnimalNotFoundException;
use App\Exceptions\InvalidPetUpdateRequestException;
use App\Handlers\Animal\AnimalUpdate\AnimalUpdateCommand;
use App\Handlers\Animal\AnimalUpdate\AnimalUpdateHandler;
use App\Repositories\AnimalRepositoryInterface;
use Illuminate\Support\Facades\Auth;

readonly class UpdateUserPetAnimalHandler
{
    public function __construct(
        private AnimalUpdateHandler $animalUpdateHandler,
        private AnimalRepositoryInterface $animalRepository,
    ){
    }

    /**
     * @throws AnimalNotFoundException
     * @throws InvalidPetUpdateRequestException
     */
    public function handle(AnimalUpdateCommand $command): AnimalDTO
    {
        $animal = $this->animalRepository->getAnimalById($command->animalId);

        if (Auth::user()->id !== $animal->user_id){
            throw new InvalidPetUpdateRequestException();
        }
        return $this->animalUpdateHandler->handle($command);
    }

}
