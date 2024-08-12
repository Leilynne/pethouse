<?php

declare(strict_types=1);

namespace App\Handlers\Tags;

use App\Repositories\TagRepositoryInterface;

readonly class TagDeleteHandler
{

    public function __construct(
       private TagRepositoryInterface $repository
    ){
    }

    public function handle(int $tagId): void
    {
        $tag = $this->repository->getTagById($tagId);
        $tag->delete();
    }



}
