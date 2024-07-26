<?php

declare(strict_types=1);

namespace App\Http\Controllers\ColorController;

use App\Handlers\Color\ColorCreateHandler;
use App\Handlers\Color\ColorDeleteHandler;
use App\Handlers\Color\ColorGetAllHandler;
use App\Handlers\Color\ColorShowHandler;
use App\Handlers\Color\ColorUpdateHandler;
use App\Http\Requests\Color\CreateColorRequest;
use App\Http\Requests\Color\UpdateColorRequest;
use App\Http\Resources\ColorResource;
use App\Http\Resources\SuccessResponseResource;
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
        $color = $this->colorCreateHandler->handle($request->validated());

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
        $color = $this->colorUpdateHandler->handle($request->validated(), $colorId);

        return new ColorResource($color);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $colorId): SuccessResponseResource
    {
        $this->colorDeleteHandler->handle($colorId);

        return new SuccessResponseResource(['message' => "Color $colorId deleted successfully"]);
    }
}
