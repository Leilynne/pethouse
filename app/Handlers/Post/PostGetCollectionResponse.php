<?php

namespace App\Handlers\Post;

use App\DTO\PostDTO;

readonly class PostGetCollectionResponse
{
    /**
     * @param PostDTO[] $post
     */
    public function __construct(
        public array $post,
        public int $total,
        public int $lastPage,
        public int $currentPage,
    ) {
    }
}
