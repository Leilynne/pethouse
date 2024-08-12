<?php

declare(strict_types=1);

namespace App\Handlers\Color;

use App\DTO\ColorDTO;
use App\Mappers\ColorMapper;
use App\Repositories\ColorRepositoryInterface;

readonly class ColorGetAllHandler
{
    public function __construct(
        private ColorRepositoryInterface $colorRepository
    ) {
    }

    /**
     * @return  ColorDTO[]
     */
    public function handle(): array
    {
        return ColorMapper::mapModelsToDTOArray($this->colorRepository->getAllColors());
    }
}
