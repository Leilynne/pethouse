<?php

declare(strict_types=1);

namespace App\Http\Controllers;


use App\Enums\MediaEntityType;
use App\Handlers\Media\MediaCreate\MediaCreateCommand;
use App\Handlers\Media\MediaCreate\MediaCreateHandler;
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
        $data = $request->validated();
        $media = $this->mediaCreateHandler->handle(
            new MediaCreateCommand(
                (int) $data['entity_id'],
                MediaEntityType::from($data['entity_type']),
                $data['photo'],
            )
        );

         return new MediaResource($media);
    }









}
