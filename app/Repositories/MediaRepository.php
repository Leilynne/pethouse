<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Media;

class MediaRepository implements MediaRepositoryInterface
{

    /**
     * @param int $id
     * @return Media
     */
    public function getMediaById(int $id): Media
    {
        return Media::where('id', $id)->first();
    }
}
