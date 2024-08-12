<?php

namespace App\DTO;

class ColorDTO
{
    public function __construct(
        public int $id,
        public string $name,
    ) {
    }
}
