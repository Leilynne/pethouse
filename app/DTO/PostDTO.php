<?php

namespace App\DTO;


class PostDTO
{
    /**
     * @param MediaDTO[] $photos
     */
    public function __construct(
        public int $id,
        public string $description,
        public string $title,
        public MediaDTO $preview,
        public array $photos,
    ) {
    }
}
