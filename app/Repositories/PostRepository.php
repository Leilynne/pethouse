<?php

namespace App\Repositories;

use App\Exceptions\PostNotFoundException;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostRepository implements PostRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function getAllPosts(): Collection
    {
        return Post::all();
    }

    public function getPostById(int $id, array $relations = []): Post
    {
        return Post::with($relations)->where(['id'=> $id])->first() ?? throw new PostNotFoundException();
    }
}
