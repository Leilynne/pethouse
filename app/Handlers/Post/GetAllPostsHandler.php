<?php

declare(strict_types=1);

namespace App\Handlers\Post;

use App\Mappers\PostMapper;
use App\Repositories\PostRepositoryInterface;

readonly class GetAllPostsHandler
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    ){
    }

    /**
     * @param PostGetCollectionCommand $command
     * @return PostGetCollectionResponse
     */
    public function handle(PostGetCollectionCommand $command): PostGetCollectionResponse
    {
        $paginator = $this->postRepository->getAllPosts($command->page);

        return new PostGetCollectionResponse(
            PostMapper::mapModelsToDTOArray($paginator->items()),
            $paginator->total(),
            $paginator->lastPage(),
            $paginator->currentPage(),
        );
    }

}
