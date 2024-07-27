<?php

declare(strict_types=1);

namespace App\Handlers\Media;

use App\Repositories\MediaRepository;

readonly class MediaDeleteHandler
{
    public function __construct(
        private MediaRepository $mediaRepository
    ){
    }

    public function handle(int $mediaId): void
    {
        $photo = $this->mediaRepository->getMediaById($mediaId);
        \Storage::disk('public')->delete('animals/'.$photo->file_name);

        $photo->delete();
    }
}
