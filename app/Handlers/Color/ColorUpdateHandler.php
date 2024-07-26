<?php

declare(strict_types=1);

namespace App\Handlers\Color;

use App\Models\Color;
use App\Repositories\ColorRepository;

readonly class ColorUpdateHandler
{
    public function __construct(
        private ColorRepository $colorRepository
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public function handle(array $data, int $colorId): Color
    {
        $color = $this->colorRepository->getColorById($colorId);
        $color->update($data);

        return $color;
    }
}
