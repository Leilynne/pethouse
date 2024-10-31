<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PostRepositoryInterface
{
    /**
     * @return LengthAwarePaginator
     */
    public function getAllPosts(): LengthAwarePaginator;


    /**
     * @param int $id
     * @param string[] $relations
     * @return Post
     */
    public function getPostById(int $id, array $relations): Post;
}
