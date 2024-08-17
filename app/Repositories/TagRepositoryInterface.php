<?php

namespace App\Repositories;

use App\Models\Tag;
use Illuminate\Support\Collection;

interface TagRepositoryInterface
{
    /**
     * @return Collection<int, Tag>
     */
    public function getAllTags(): Collection;


    public function getTagById(int $id): Tag;
}
