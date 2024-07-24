<?php

namespace App\Repositories;

use App\Models\Color;
use App\Repositories\ColorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ColorRepository implements ColorRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function getAllColors(): Collection
    {
        return Color::all();
    }

    public function getColorById(int $id): Color
    {
        return Color::where(['id' => $id])->first();
    }
}
