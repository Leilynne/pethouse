<?php

declare(strict_types=1);

namespace App\Handlers\Post;

use App\Repositories\PostRepository;
use Illuminate\Database\Eloquent\Collection;

readonly class GetAllPostsHandler
{
    public function __construct(
        private PostRepository $postRepository
    ){
    }

    public function handle(): Collection
    {
        return $this->postRepository->getAllPosts();
    }

}
