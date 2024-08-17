<?php

namespace App\Repositories;

use App\Models\Color;
use Illuminate\Support\Collection;

class ColorRepository implements ColorRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function getAllColors(): Collection
    {
        return Color::orderBy('name')->get();
    }

    public function getColorById(int $id): Color
    {
        return Color::where(['id' => $id])->first();
    }
}
