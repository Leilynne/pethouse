<?php

declare(strict_types=1);

namespace App\Handlers\Color;

use App\Models\Color;
use App\Repositories\ColorRepository;

readonly class ColorShowHandler
{

    public function __construct(
        private ColorRepository $repository
    ){
    }


    public function handle(int $colorId): Color
    {
        return $this->repository->getColorById($colorId);
    }
}
