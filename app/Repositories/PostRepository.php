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
        return Post::with('preview')->orderBy('created_at', 'desc')->get();
    }

    public function getPostById(int $id, array $relations = []): Post
    {
        return Post::with($relations)->where(['id'=> $id])->first() ?? throw new PostNotFoundException();
    }
}
