<?php

declare(strict_types=1);

namespace App\Handlers\Media;

use App\Models\Animal;
use App\Repositories\MediaRepositoryInterface;
use Illuminate\Contracts\Filesystem\Filesystem;

readonly class MediaDeleteHandler
{
    public function __construct(
        private MediaRepositoryInterface $mediaRepository,
        private Filesystem $filesystem,
    ) {
    }

    public function handle(int $mediaId): void
    {
        $photo = $this->mediaRepository->getMediaById($mediaId);
        if ($photo->entity instanceof Animal) {
            $folder = 'animals/';
        } else {
            $folder = 'posts/';
        }
        $this->filesystem->delete($folder . $photo->file_name);

        $photo->delete();
    }
}
