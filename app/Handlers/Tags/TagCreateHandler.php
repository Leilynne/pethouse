<?php

declare(strict_types=1);

namespace App\Handlers\Tags;

use App\Models\Tag;

readonly class TagCreateHandler
{
    /**
     * @param array<string, mixed> $data
     * @return Tag $tag
     */
    public function handle(array $data): Tag
    {
        /**
         * @var Tag $tag
         */
        $tag = Tag::create($data);

        return $tag;
    }

}
