<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\PostRepositoryInterface;
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

    public function getPostById(int $id): Post
    {
        return Post::where(['id'=> $id])->first();
    }

    /**
     * @inheritDoc
     */
    public function getPostByAnimalId(int $animal_id): Collection
    {
       return Post::where(['animal_id'=> $animal_id])->get();
    }
}
