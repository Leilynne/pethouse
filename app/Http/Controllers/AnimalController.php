<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\AnimalAge;
use App\Enums\AnimalHealth;
use App\Enums\AnimalSex;
use App\Enums\AnimalStatus;
use App\Enums\AnimalType;
use App\Enums\UserRole;
use App\Exceptions\AnimalNotFoundException;
use App\Handlers\Animal\AnimalAddCuratorHandler;
use App\Handlers\Animal\AnimalCreate\AnimalCreateCommand;
use App\Handlers\Animal\AnimalCreate\AnimalCreateHandler;
use App\Handlers\Animal\AnimalDeleteCuratorHandler;
use App\Handlers\Animal\AnimalDeleteHandler;
use App\Handlers\Animal\AnimalGetCollection\AnimalGetAllHandler;
use App\Handlers\Animal\AnimalGetCollection\AnimalGetCollectionCommand;
use App\Handlers\Animal\AnimalShowHandler;
use App\Handlers\Animal\AnimalUpdate\AnimalUpdateCommand;
use App\Handlers\Animal\AnimalUpdate\AnimalUpdateHandler;
use App\Http\Requests\Animal\AnimalPaginatorRequest;
use App\Http\Requests\Animal\CreateAnimalRequest;
use App\Http\Requests\Animal\UpdateAnimalRequest;
use App\Http\Resources\AnimalCollectionResource;
use App\Http\Resources\AnimalResource;
use App\Http\Resources\SuccessfulResponseResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isFalse;

readonly class AnimalController
{
    public function __construct(
        private AnimalCreateHandler     $animalCreateHandler,
        private AnimalGetAllHandler     $animalGetAllHandler,
        private AnimalDeleteHandler     $animalDeleteHandler,
        private AnimalShowHandler       $animalShowHandler,
        private AnimalUpdateHandler     $animalUpdateHandler,
        private AnimalAddCuratorHandler $animalAddCuratorHandler,
        private AnimalDeleteCuratorHandler $animalDeleteCuratorHandler,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(AnimalPaginatorRequest $request): AnimalCollectionResource
    {
        $data = $request->validated();
        $userRole = Auth::user()->role;

        return new AnimalCollectionResource(
            $this->animalGetAllHandler->handle(
                new AnimalGetCollectionCommand(
                    (int) ($data['page'] ?? 1),
                    isset($data['color']) ? (int) $data['color'] : null,
                    isset($data['type']) ? AnimalType::from($data['type']) : null,
                    isset($data['sex']) ? AnimalSex::from($data['sex']) : null,
                    isset($data['health']) ? AnimalHealth::from($data['health']) : null,
                     $userRole,
                    isset($data['status']) ? AnimalStatus::from($data['status']) : null,
                     $data['tags'] ?? [],
                    isset($data['age']) ? AnimalAge::from($data['age']) : null,
                )
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAnimalRequest $request): AnimalResource
    {
        $data = $request->validated();
        $animal = $this->animalCreateHandler->handle(
            new AnimalCreateCommand(
                $data['name'],
                isset($data['birthday']) ? Carbon::createFromFormat('Y-m-d', $data['birthday']) : null,
                AnimalSex::from($data['sex']),
                AnimalType::from($data['type']),
                AnimalHealth::from($data['health']),
                AnimalStatus::from($data['animal_status']),
                (int) $data['color_id'],
                isset($data['user_id']) ? (int) $data['user_id'] : null,
                $data['comment'] ?? null,
                $data['description'],
                $data['preview'],
                $data['tags'] ?? [],
            )
        );

        return new AnimalResource($animal);
    }

    /**
     * Display the specified resource.
     * @throws AnimalNotFoundException
     */
    public function show(int $animalId): AnimalResource
    {
        $animal = $this->animalShowHandler->handle($animalId);

        return new AnimalResource($animal);
    }

    /**
     * Update the specified resource in storage.
     * @throws AnimalNotFoundException
     */
    public function update(UpdateAnimalRequest $request, int $animalId): AnimalResource
    {
        $data = $request->validated();

        $animal = $this->animalUpdateHandler->handle(
            new AnimalUpdateCommand(
                $animalId,
                $data['name'],
                isset($data['birthday']) ? Carbon::createFromFormat('Y-m-d', $data['birthday']) : null,
                AnimalSex::from($data['sex']),
                AnimalType::from($data['type']),
                AnimalHealth::from($data['health']),
                AnimalStatus::from($data['animal_status']),
                (int) $data['color_id'],
                isset($data['user_id']) ? (int) $data['user_id'] : null,
                $data['comment'] ?? null,
                $data['description'],
                $data['preview'] ?? null,
                $data['tags'] ?? [],
            )
        );

        return new AnimalResource($animal);
    }

    /**
     * Remove the specified resource from storage.
     * @throws AnimalNotFoundException
     */
    public function destroy(int $animalId): SuccessfulResponseResource
    {
        $this->animalDeleteHandler->handle($animalId);

        return new SuccessfulResponseResource("Animal $animalId deleted successfully");
    }

    /**
     * @throws AnimalNotFoundException
     */
    public function addCurator(int $animalId): SuccessfulResponseResource
    {
        $userId = Auth::user()->id;
        $this->animalAddCuratorHandler->handle($animalId, $userId);

        return new SuccessfulResponseResource("Congratulation!");
    }

    public function deleteCurator(int $animalId): SuccessfulResponseResource
    {
        $userId = Auth::user()->id;
        $this->animalDeleteCuratorHandler->handle($animalId, $userId);

        return new SuccessfulResponseResource("you have ceased to be the curator of this animal.");
    }
}
