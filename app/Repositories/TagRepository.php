<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\TagRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TagRepository implements TagRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function getAllTags(): Collection
    {
        return Tag::all();
    }

    public function getTagById(int $id): Tag
    {
        return Tag::where(['id' => $id])->first();
    }
}
