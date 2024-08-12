<?php

declare(strict_types=1);

namespace App\Handlers\Post;

use App\DTO\PostDTO;
use App\Mappers\PostMapper;
use App\Repositories\PostRepositoryInterface;

readonly class GetPostByIdHandler
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
    ){
    }

    public function handle(int $postId): PostDTO
    {
        return PostMapper::mapModelToDTO($this->postRepository->getPostById($postId, ['photos']));
    }
}
