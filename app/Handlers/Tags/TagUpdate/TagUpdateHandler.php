<?php

declare(strict_types=1);

namespace App\Handlers\Tags\TagUpdate;

use App\DTO\TagDTO;
use App\Mappers\TagMapper;
use App\Repositories\TagRepositoryInterface;

readonly class TagUpdateHandler
{
    public function __construct(
        private TagRepositoryInterface $tagRepository,
    ){
    }

    public function handle(TagUpdateCommand $command): TagDTO
    {
        $tag = $this->tagRepository->getTagById($command->tagId);
        $tag->update([
            'name' => $command->name,
            ]
        );

        return TagMapper::mapModelToDTO($tag);
    }

}
