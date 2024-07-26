<?php

declare(strict_types=1);

namespace App\Handlers\Color;

use App\Models\Color;
use App\Repositories\ColorRepository;
use Illuminate\Database\Eloquent\Collection;

readonly class ColorGetAllHandler
{
    public function __construct(
        private ColorRepository $colorRepository
    ) {
    }

    /**
     * @return  Collection<int, Color>
     */
    public function handle(): Collection
    {
        return $this->colorRepository->getAllColors();
    }
}
