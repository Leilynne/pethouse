<?php

namespace App\DTO;

class MediaDTO
{
    public function __construct(
        public int $id,
        public string $fileName,
        public bool $primary,
    ) {
    }
}
