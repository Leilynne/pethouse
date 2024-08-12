<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\AnimalHealth;
use App\Enums\AnimalSex;
use App\Enums\AnimalStatus;
use App\Enums\AnimalType;
use App\Exceptions\AnimalNotFoundException;
use App\Exceptions\InvalidPetUpdateRequestException;
use App\Handlers\Animal\AnimalCreate\AnimalCreateCommand;
use App\Handlers\Animal\AnimalCreate\AnimalCreateHandler;
use App\Handlers\Animal\AnimalUpdate\AnimalUpdateCommand;
use App\Handlers\Profile\GetAllUserPetAnimalsHandler;
use App\Handlers\Profile\GetProfileHandler;
use App\Handlers\Profile\GetUserSupervisedAnimalHandler;
use App\Handlers\Profile\UpdateProfileHandler;
use App\Handlers\Profile\UpdateUserPetAnimalHandler;
use App\Handlers\Profile\UserCancelAdoptionRequestHandler;
use App\Handlers\Profile\UserGetAdoptionRequestHandler;
use App\Handlers\User\UserUpdate\UserUpdateCommand;
use App\Http\Requests\Animal\CreateUserPetAnimalRequest;
use App\Http\Requests\Animal\UpdateUserPetAnimalRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\AdoptionRequestResource;
use App\Http\Resources\AnimalResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

readonly class ProfileController
{
    public function __construct(
        private GetProfileHandler                $getProfileHandler,
        private UpdateProfileHandler             $updateProfileHandler,
        private UpdateUserPetAnimalHandler       $updateUserPetAnimalHandler,
        private AnimalCreateHandler              $animalCreateHandler,
        private GetAllUserPetAnimalsHandler      $allUserPetAnimalsHandler,
        private GetUserSupervisedAnimalHandler   $getUserSupervisedAnimalHandler,
        private UserGetAdoptionRequestHandler    $userGetAdoptionRequestHandler,
        private UserCancelAdoptionRequestHandler $userCancelAdoptionRequestHandler,
    ){
    }

    public function show(): UserResource
    {
        return new UserResource($this->getProfileHandler->handle());
    }

    public function update(UpdateUserRequest $request): UserResource
    {
        $data = $request->validated();

        return new UserResource($this->updateProfileHandler->handle(
            new UserUpdateCommand(
                Auth::user(),
                $data['name'],
                $data['email'],
                $data['phone'],
            )
        ));
    }

    public function createMyAnimal(CreateUserPetAnimalRequest $request): AnimalResource
    {
        $data = $request->validated();

        return new AnimalResource($this->animalCreateHandler->handle(
            new AnimalCreateCommand(
                $data['name'],
                isset($data['birthday']) ? Carbon::createFromFormat('Y-m-d', $data['birthday']) : null,
                AnimalSex::from($data['sex']),
                AnimalType::from($data['type']),
                AnimalHealth::from($data['health']),
                AnimalStatus::Household,
                (int) $data['color_id'],
                Auth::id(),
                $data['comment'] ?? null,
                $data['description'],
                $data['preview'],
                $data['tags'] ?? [],

            )
        ));
    }

    /**
     * @throws AnimalNotFoundException
     * @throws InvalidPetUpdateRequestException
     */
    public function updateMyAnimal(UpdateUserPetAnimalRequest $request, int $animalId): AnimalResource
    {
        $data = $request->validated();

        return new AnimalResource($this->updateUserPetAnimalHandler->handle(
            new AnimalUpdateCommand(
                $animalId,
                $data['name'],
                isset($data['birthday']) ? Carbon::createFromFormat('Y-m-d', $data['birthday']) : null,
                AnimalSex::from($data['sex']),
                AnimalType::from($data['type']),
                AnimalHealth::from($data['health']),
                AnimalStatus::Household,
                (int) $data['color_id'],
                Auth::id(),
                $data['comment'] ?? null,
                $data['description'],
                $data['preview'] ?? null,
                $data['tags'] ?? [],
            )
        ));
    }

    public function getAllMyAnimals(): AnonymousResourceCollection
    {
        $user = Auth::user();
        return AnimalResource::collection($this->allUserPetAnimalsHandler->handle($user));
    }

    public function getAllMySupervisedAnimals(): AnonymousResourceCollection
    {
        return AnimalResource::collection($this->getUserSupervisedAnimalHandler->handle(Auth::user()));
    }

    public function getUserAdoptionRequest(): AnonymousResourceCollection
    {
        $userId = Auth::user()->id;
        return AdoptionRequestResource::collection($this->userGetAdoptionRequestHandler->handle($userId));
    }

    public function cancelAdoptionRequest(int $adoptionRequestId): AdoptionRequestResource
    {
        return new AdoptionRequestResource($this->userCancelAdoptionRequestHandler->handle($adoptionRequestId));
    }

}
