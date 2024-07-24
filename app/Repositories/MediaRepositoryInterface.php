<?php

namespace App\Repositories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Collection;

interface MediaRepositoryInterface
{
    /**
     * @param $animal_id
     * @return Collection<int, Media>
     */
    public function getAllMediaByAnimal($animal_id): Collection;
}
