<?php

namespace App\Handlers\User\UserGetCollection;

use App\DTO\UserDTO;

readonly class UserGetCollectionResponse
{
    /**
     * @param UserDTO[] $users
     * @param int $total
     * @param int $lastPage
     */
    public function __construct(
        public array $users,
        public int $total,
        public int $lastPage,
    ) {
    }
}
