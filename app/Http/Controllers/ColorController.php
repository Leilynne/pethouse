<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Handlers\Color\ColorCreate\ColorCreateCommand;
use App\Handlers\Color\ColorCreate\ColorCreateHandler;
use App\Handlers\Color\ColorDeleteHandler;
use App\Handlers\Color\ColorGetAllHandler;
use App\Handlers\Color\ColorShowHandler;
use App\Handlers\Color\ColorUpdate\ColorUpdateCommand;
use App\Handlers\Color\ColorUpdate\ColorUpdateHandler;
use App\Http\Requests\Color\CreateColorRequest;
use App\Http\Requests\Color\UpdateColorRequest;
use App\Http\Resources\ColorResource;
use App\Http\Resources\SuccessfulResponseResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

readonly class ColorController
{
    public function __construct(
        private ColorGetAllHandler $colorGetAllHandler,
        private ColorCreateHandler $colorCreateHandler,
        private ColorShowHandler $colorShowHandler,
        private ColorUpdateHandler $colorUpdateHandler,
        private ColorDeleteHandler $colorDeleteHandler,
    ){
    }


    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $colors = $this->colorGetAllHandler->handle();

        return ColorResource::collection($colors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateColorRequest $request): ColorResource
    {
        $data = $request->validated();
        $color = $this->colorCreateHandler->handle(
            new ColorCreateCommand(
                (string) $data['name'],
            )
        );

        return new ColorResource($color);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $colorId): ColorResource
    {
        $color = $this->colorShowHandler->handle($colorId);

        return new ColorResource($color);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColorRequest $request, int $colorId): ColorResource
    {
        $data = $request->validated();
        $color = $this->colorUpdateHandler->handle(
            new ColorUpdateCommand(
                $colorId,
                (string) $data['name'],
            )
        );

        return new ColorResource($color);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $colorId): SuccessfulResponseResource
    {
        $this->colorDeleteHandler->handle($colorId);

        return new SuccessfulResponseResource("Color $colorId deleted successfully");
    }
}
