<?php

namespace App\Handlers\Animal\AnimalGetCollection;

use App\DTO\AnimalDTO;

readonly class AnimalGetCollectionResponse
{
    /**
     * @param AnimalDTO[] $animals
     */
    public function __construct(
        public array $animals,
        public int $total,
        public int $lastPage,
        public int $currentPage,
    ) {
    }
}
