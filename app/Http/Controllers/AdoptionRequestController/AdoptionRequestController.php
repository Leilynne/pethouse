<?php

declare(strict_types=1);

namespace App\Http\Controllers\AdoptionRequestController;

use App\Handlers\AdoptionRequest\AdoptionRequestCreateHandler;
use App\Handlers\AdoptionRequest\AdoptionRequestGetAllHandler;
use App\Handlers\AdoptionRequest\AdoptionRequestShowHandler;
use App\Handlers\AdoptionRequest\AdoptionRequestUpdateHandler;
use App\Http\Requests\AdoptionRequest\CreateAdoptionRequest;
use App\Http\Requests\AdoptionRequest\UpdateAdoptionRequest;
use App\Http\Resources\Admin\AdminAdoptionResource;
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


    public function store(CreateAdoptionRequest $request): AdminAdoptionResource
    {
        $adoptionRequest =  $this->adoptionRequestCreateHandler->handle($request->validated());

        return new AdminAdoptionResource($adoptionRequest);
    }

    public function show(int $adoptionRequestId): AdminAdoptionResource
    {
        return new AdminAdoptionResource($this->adoptionRequestShowHandler->handle($adoptionRequestId));
    }

    public function index(): AnonymousResourceCollection
    {
        return AdminAdoptionResource::collection(
            $this->adoptionRequestGetAllHandler->handle()
        );
    }

    public function update(UpdateAdoptionRequest $request, int $adoptionRequestId): AdminAdoptionResource
    {
        $adoptionRequest = $this->adoptionRequestUpdateHandler->handle($request->validated(), $adoptionRequestId);

        return new AdminAdoptionResource($adoptionRequest);
    }

}
