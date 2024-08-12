<?php

declare(strict_types=1);

namespace App\Handlers\Color;

use App\Repositories\ColorRepositoryInterface;

readonly class ColorDeleteHandler
{
    public function __construct(
        private ColorRepositoryInterface $colorRepository
    ) {
    }

    public function handle(int $colorId): void
    {
        $animal = $this->colorRepository->getColorById($colorId);
        $animal->delete();
    }
}
