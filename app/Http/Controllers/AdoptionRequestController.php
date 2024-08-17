<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\AdoptionStatus;
use App\Handlers\AdoptionRequest\AdoptionRequestCreate\AdoptionRequestCreateCommand;
use App\Handlers\AdoptionRequest\AdoptionRequestCreate\AdoptionRequestCreateHandler;
use App\Handlers\AdoptionRequest\AdoptionRequestGetCollection\AdoptionRequestGetAllHandler;
use App\Handlers\AdoptionRequest\AdoptionRequestGetCollection\AdoptionRequestGetCollectionCommand;
use App\Handlers\AdoptionRequest\AdoptionRequestShowHandler;
use App\Handlers\AdoptionRequest\AdoptionRequestUpdate\AdoptionRequestUpdateCommand;
use App\Handlers\AdoptionRequest\AdoptionRequestUpdate\AdoptionRequestUpdateHandler;
use App\Http\Requests\AdoptionRequest\AdoptionRequestPaginatorRequest;
use App\Http\Requests\AdoptionRequest\CreateAdoptionRequest;
use App\Http\Requests\AdoptionRequest\UpdateAdoptionRequest;
use App\Http\Resources\AdoptionRequestCollectionResource;
use App\Http\Resources\AdoptionRequestResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

readonly class AdoptionRequestController
{

    public function __construct(
        private AdoptionRequestGetAllHandler $adoptionRequestGetAllHandler,
        private AdoptionRequestShowHandler $adoptionRequestShowHandler,
        private AdoptionRequestCreateHandler $adoptionRequestCreateHandler,
        private AdoptionRequestUpdateHandler $adoptionRequestUpdateHandler,
    ){
    }


    public function store(CreateAdoptionRequest $request): AdoptionRequestResource
    {
        $data = $request->validated();
        $adoptionRequest = $this->adoptionRequestCreateHandler->handle(
            new AdoptionRequestCreateCommand(
                (int) $data['user_id'],
                (int) $data['animal_id'],
            )
        );

        return new AdoptionRequestResource($adoptionRequest);
    }

    public function show(int $adoptionRequestId): AdoptionRequestResource
    {
        return new AdoptionRequestResource($this->adoptionRequestShowHandler->handle($adoptionRequestId));
    }

    public function index(AdoptionRequestPaginatorRequest $request): AdoptionRequestCollectionResource
    {
        $data = $request->validated();

        return new AdoptionRequestCollectionResource(
            $this->adoptionRequestGetAllHandler->handle(
                new AdoptionRequestGetCollectionCommand(
                    (int) ($data['page'] ?? 1),
                    isset($data['status']) ? AdoptionStatus::from($data['status']) : null,
                )
            )
        );
    }

    public function update(UpdateAdoptionRequest $request, int $id): AdoptionRequestResource
    {
        $data = $request->validated();
        $adoptionRequest = $this->adoptionRequestUpdateHandler->handle(
            new AdoptionRequestUpdateCommand(
                $id,
                AdoptionStatus::from($data['status']),
            )
        );

        return new AdoptionRequestResource($adoptionRequest);
    }

}
