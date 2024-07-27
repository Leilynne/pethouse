<?php

namespace App\Repositories;

use App\Models\Media;

interface MediaRepositoryInterface
{
    /**
     * @param int $id
     * @return Media
     */
    public function getMediaById(int $id): Media;
}
