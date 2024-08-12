<?php

declare(strict_types=1);

namespace App\Handlers\Post;

use App\DTO\PostDTO;
use App\Mappers\PostMapper;
use App\Repositories\PostRepositoryInterface;

readonly class GetAllPostsHandler
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    ){
    }

    /**
     * @return PostDTO[]
     */
    public function handle(): array
    {
        return PostMapper::mapModelsToDTOArray($this->postRepository->getAllPosts());
    }

}
