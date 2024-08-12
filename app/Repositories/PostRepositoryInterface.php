<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{
    /**
     * @return Collection<int, Post>
     **/
    public function getAllPosts(): Collection;


    /**
     * @param int $id
     * @param string[] $relations
     * @return Post
     */
    public function getPostById(int $id, array $relations): Post;
}
