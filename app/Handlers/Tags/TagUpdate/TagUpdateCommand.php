<?php

declare(strict_types=1);

namespace App\Handlers\Tags\TagUpdate;

readonly class TagUpdateCommand
{
    public function __construct(
        public int $tagId,
        public string $name,
    ) {
    }
}
