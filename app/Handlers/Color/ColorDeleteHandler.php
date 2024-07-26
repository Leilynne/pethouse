<?php

declare(strict_types=1);

namespace App\Handlers\Color;

use App\Repositories\ColorRepository;

readonly class ColorDeleteHandler
{
    public function __construct(
        private ColorRepository $colorRepository
    ) {
    }

    public function handle(int $colorId): void
    {
        $animal = $this->colorRepository->getColorById($colorId);
        $animal->delete();
    }
}
