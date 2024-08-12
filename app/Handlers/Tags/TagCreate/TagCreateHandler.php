<?php

declare(strict_types=1);

namespace App\Handlers\Tags\TagCreate;

use App\DTO\TagDTO;
use App\Mappers\TagMapper;
use App\Models\Tag;

readonly class TagCreateHandler
{
    public function handle(TagCreateCommand $command): TagDTO
    {
        /**
         * @var Tag $tag
         */
        $tag = Tag::create([
            'name' => $command->name,
        ]);

        return TagMapper::mapModelToDTO($tag);
    }

}
