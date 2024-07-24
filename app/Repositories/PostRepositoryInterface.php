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


    public function getPostById(int $id): Post;


    /**
     * @param int $animal_id
     * @return Collection<int, Post>
     */
    public function getPostByAnimalId(int $animal_id): Collection;
}
