<?php

namespace App\Repositories;

use App\Models\Tag;
use Illuminate\Support\Collection;

class TagRepository implements TagRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function getAllTags(): Collection
    {
        return Tag::orderBy('name')->get();
    }

    public function getTagById(int $id): Tag
    {
        return Tag::where(['id' => $id])->first();
    }
}
