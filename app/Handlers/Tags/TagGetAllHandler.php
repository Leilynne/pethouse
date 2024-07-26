<?php

declare(strict_types=1);

namespace App\Handlers\Tags;

use App\Repositories\TagRepository;
use Illuminate\Database\Eloquent\Collection;

readonly  class TagGetAllHandler
{
    public function __construct(
        private TagRepository $tagRepository,
    ){
    }

    public function handle(): Collection
    {
        return $this->tagRepository->getAllTags();
    }

}
