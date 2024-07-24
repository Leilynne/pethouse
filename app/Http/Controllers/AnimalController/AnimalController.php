<?php

declare(strict_types=1);

namespace App\Http\Controllers\AnimalController;

use App\Exceptions\AnimalNotFoundException;
use App\Handlers\Animal\AnimalCreateHandler;
use App\Handlers\Animal\AnimalDeleteHandler;
use App\Handlers\Animal\AnimalGetAllHandler;
use App\Handlers\Animal\AnimalShowHandler;
use App\Http\Requests\Animal\CreateAnimalRequest;
use App\Http\Resources\AnimalResource;
use App\Http\Resources\SuccessResponseResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

readonly class AnimalController
{
    public function __construct(
        private AnimalCreateHandler $animalCreateHandler,
        private AnimalGetAllHandler $animalGetAllHandler,
        private AnimalDeleteHandler $animalDeleteHandler,
        private AnimalShowHandler  $animalShowHandler,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return AnimalResource::collection(
            $this->animalGetAllHandler->handle()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAnimalRequest $request): AnimalResource
    {
        $animal = $this->animalCreateHandler->handle($request->validated());

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
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $animalId): SuccessResponseResource
    {
        $this->animalDeleteHandler->handle($animalId);

        return new SuccessResponseResource(['message' => "Animal $animalId deleted successfully"]);
    }
}
