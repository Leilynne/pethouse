<?php

namespace App\Handlers\User\UserGetCollection;


readonly class UserGetCollectionCommand
{
    public function __construct(
        public int $page,
        public ?string $name,
    ) {
    }
}
