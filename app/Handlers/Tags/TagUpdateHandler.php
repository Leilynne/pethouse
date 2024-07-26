<?php

declare(strict_types=1);

namespace App\Handlers\Tags;

use App\Models\Tag;
use App\Repositories\TagRepository;

readonly class TagUpdateHandler
{
    public function __construct(
        private TagRepository $tagRepository,
    ){
    }

    public function handle(array $data, int $tagId): Tag
    {
        $tag = $this->tagRepository->getTagById($tagId);
        $tag->update($data);

        return $tag;
    }

}
