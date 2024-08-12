<?php

declare(strict_types=1);

namespace App\Handlers\Color\ColorCreate;

use App\DTO\ColorDTO;
use App\Mappers\ColorMapper;
use App\Models\Color;

readonly class ColorCreateHandler
{

    public function handle(ColorCreateCommand $command): ColorDTO
    {
        /* @var Color $color */
        $color = Color::create([
            'name' => $command->name,
        ]);

        return ColorMapper::mapModelToDTO($color);
    }
}
