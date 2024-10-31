<?php

namespace App\Handlers\Post;


readonly class PostGetCollectionCommand
{
    public function __construct(
        public int $page,

    ) {
    }
}
