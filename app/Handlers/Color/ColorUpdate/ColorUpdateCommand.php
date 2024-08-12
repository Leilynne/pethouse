<?php

declare(strict_types=1);

namespace App\Handlers\Color\ColorUpdate;

readonly class ColorUpdateCommand
{
    public function __construct(
        public int $colorId,
        public string $name,
    ) {
    }
}
