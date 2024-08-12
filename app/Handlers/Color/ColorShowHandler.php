<?php

declare(strict_types=1);

namespace App\Handlers\Color;

use App\DTO\ColorDTO;
use App\Mappers\ColorMapper;
use App\Repositories\ColorRepositoryInterface;

readonly class ColorShowHandler
{

    public function __construct(
        private ColorRepositoryInterface $repository
    ){
    }


    public function handle(int $colorId): ColorDTO
    {
        return ColorMapper::mapModelToDTO($this->repository->getColorById($colorId));
    }
}
