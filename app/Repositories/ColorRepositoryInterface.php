<?php

namespace App\Repositories;

use App\Models\Color;
use Illuminate\Support\Collection;

interface ColorRepositoryInterface
{
    /**
     * @return Collection<int, Color>
     */
    public function getAllColors(): Collection;

    public function getColorById(int $id): Color;
}
