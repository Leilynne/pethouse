<?php

declare(strict_types=1);

namespace App\Handlers\Media;

use App\Models\Animal;
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
        if ($photo->entity instanceof Animal) {
            $folder = 'animals/';
        } else {
            $folder = 'posts/';
        }
        \Storage::disk('public')->delete($folder.$photo->file_name);

        $photo->delete();
    }
}
