<?php

declare(strict_types=1);

namespace App\Handlers\Tags;

use App\Repositories\TagRepository;

readonly class TagDeleteHandler
{

    public function __construct(
       private TagRepository $repository
    ){
    }

    public function handle(int $tagId): void
    {
        $tag = $this->repository->getTagById($tagId);
        $tag->delete();
    }



}
