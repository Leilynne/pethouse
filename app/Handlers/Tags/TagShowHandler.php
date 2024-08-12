<?php

declare(strict_types=1);

namespace App\Handlers\Tags;

use App\DTO\TagDTO;
use App\Mappers\TagMapper;
use App\Repositories\TagRepositoryInterface;

readonly class TagShowHandler
{
    public function __construct(
        private TagRepositoryInterface $tagRepository,
    ){
    }

    public function handle(int $tagId): TagDTO
    {
        return TagMapper::mapModelToDTO($this->tagRepository->getTagById($tagId));
    }

}
