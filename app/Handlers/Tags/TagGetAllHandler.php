<?php

declare(strict_types=1);

namespace App\Handlers\Tags;

use App\DTO\TagDTO;
use App\Mappers\TagMapper;
use App\Repositories\TagRepositoryInterface;

readonly  class TagGetAllHandler
{
    public function __construct(
        private TagRepositoryInterface $tagRepository,
    ){
    }

    /**
     * @return TagDTO[]
     */
    public function handle(): array
    {
        return TagMapper::mapModelsToDTOArray($this->tagRepository->getAllTags());
    }

}
