<?php

declare(strict_types=1);

namespace App\Http\Controllers\MediaController;


use App\Handlers\Media\MediaCreateHandler;
use App\Handlers\Media\MediaDeleteHandler;
use App\Http\Requests\Media\CreateMediaRequest;
use App\Http\Resources\MediaResource;
use App\Http\Resources\SuccessfulResponseResource;

readonly class MediaController
{
    public function __construct(
        private MediaDeleteHandler $mediaDeleteHandler,
        private MediaCreateHandler $mediaCreateHandler,
    ){
    }

    public function destroy(int $mediaId): SuccessfulResponseResource
    {
        $this->mediaDeleteHandler->handle($mediaId);

        return new SuccessfulResponseResource("Media $mediaId deleted successfully");
    }

    public function store(CreateMediaRequest $request): MediaResource
    {
        $media = $this->mediaCreateHandler->handle($request->validated());

         return new MediaResource($media);
    }









}
