<?php

declare(strict_types=1);

namespace App\Handlers\Color;

use App\Models\Color;

readonly class ColorCreateHandler
{
    /**
     * @param array<string, mixed> $data
     */
    public function handle(array $data): Color
    {
        /* @var Color $color */
        $color = Color::create($data);

        return $color;
    }
}
