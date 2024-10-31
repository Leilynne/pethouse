<?php

namespace App\Repositories;

use App\Exceptions\PostNotFoundException;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository implements PostRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function getAllPosts(int $page = 1): LengthAwarePaginator
    {
        return Post::with('preview')->orderBy('created_at', 'desc')->paginate(2, ['*'], 'page', $page);
    }

    public function getPostById(int $id, array $relations = []): Post
    {
        return Post::with($relations)->where(['id'=> $id])->first() ?? throw new PostNotFoundException();
    }
}
