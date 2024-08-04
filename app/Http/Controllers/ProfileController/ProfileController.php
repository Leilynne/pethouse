<?php

declare(strict_types=1);

namespace App\Http\Controllers\ProfileController;

use App\Exceptions\AnimalNotFoundException;
use App\Handlers\Profile\CreateUserPetAnimalHandler;
use App\Handlers\Profile\GetAllUserPetAnimalsHandler;
use App\Handlers\Profile\GetProfileHandler;
use App\Handlers\Profile\GetUserSupervisedAnimalHandler;
use App\Handlers\Profile\UpdateProfileHandler;
use App\Handlers\Profile\UpdateUserPetAnimalHandler;
use App\Http\Requests\Animal\CreateUserPetAnimalRequest;
use App\Http\Requests\Animal\UpdateUserPetAnimalRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Http\Resources\AnimalResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

readonly class ProfileController
{
    public function __construct(
        private GetProfileHandler $getProfileHandler,
        private UpdateProfileHandler $updateProfileHandler,
        private CreateUserPetAnimalHandler $createUserPetAnimalHandler,
        private UpdateUserPetAnimalHandler $updateUserPetAnimalHandler,
        private GetAllUserPetAnimalsHandler $allUserPetAnimalsHandler,
        private GetUserSupervisedAnimalHandler $getUserSupervisedAnimalHandler,
    ){
    }

    public function show(): UserResource
    {
        return new UserResource($this->getProfileHandler->handle());
    }

    public function update(UpdateUserRequest $request): UserResource
    {
        $data = $request->validated();

        return new UserResource($this->updateProfileHandler->handle($data));
    }

    public function createMyAnimal(CreateUserPetAnimalRequest $request): AnimalResource
    {
        $data = $request->validated();

        return new AnimalResource($this->createUserPetAnimalHandler->handle($data));
    }

    /**
     * @throws AnimalNotFoundException
     */
    public function updateMyAnimal(UpdateUserPetAnimalRequest $request, int $animalId): AnimalResource
    {
        $data = $request->validated();

        return new AnimalResource($this->updateUserPetAnimalHandler->handle($data, $animalId));
    }

    public function getAllMyAnimals(): AnonymousResourceCollection
    {
        $user = Auth::user();
        return AnimalResource::collection($this->allUserPetAnimalsHandler->handle($user));
    }

    public function getAllMySupervisedAnimals(): AnonymousResourceCollection
    {
        return AnimalResource::collection($this->getUserSupervisedAnimalHandler->handle());
    }

}
