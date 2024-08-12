<?php

declare(strict_types=1);

namespace App\Handlers\Color\ColorCreate;

readonly class ColorCreateCommand
{
    public function __construct(
        public string $name,
    ) {
    }
}
