<?php

declare(strict_types=1);

namespace App\Handlers\Color\ColorUpdate;

use App\DTO\ColorDTO;
use App\Mappers\ColorMapper;
use App\Repositories\ColorRepositoryInterface;

readonly class ColorUpdateHandler
{
    public function __construct(
        private ColorRepositoryInterface $colorRepository
    ) {
    }

    /**
     * @param ColorUpdateCommand $command
     * @return ColorDTO
     */
    public function handle(ColorUpdateCommand $command): ColorDTO
    {
        $color = $this->colorRepository->getColorById($command->colorId);
        $color->update([
            'name' => $command->name,
        ]);

        return ColorMapper::mapModelToDTO($color);
    }
}
