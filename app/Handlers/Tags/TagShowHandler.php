<?php

declare(strict_types=1);

namespace App\Handlers\Tags;

use App\Models\Tag;
use App\Repositories\TagRepository;

readonly class TagShowHandler
{
    public function __construct(
        private TagRepository $tagRepository,
    ){
    }

    public function handle(int $tagId): Tag
    {
        return $this->tagRepository->getTagById($tagId);
    }

}
