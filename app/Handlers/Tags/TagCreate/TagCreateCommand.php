<?php

namespace App\Handlers\Tags\TagCreate;

readonly class TagCreateCommand
{
    public function __construct(
        public string $name,
    ) {
    }
}
