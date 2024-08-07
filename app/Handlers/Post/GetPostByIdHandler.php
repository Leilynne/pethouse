<?php

declare(strict_types=1);

namespace App\Handlers\Post;

use App\Models\Post;
use App\Repositories\PostRepository;

readonly class GetPostByIdHandler
{
    public function __construct(
        private PostRepository $postRepository,
    ){
    }

    public function handle(int $postId): Post
    {
        return $this->postRepository->getPostById($postId);
    }
}
