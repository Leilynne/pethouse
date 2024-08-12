<?php

namespace App\Handlers\Post;

use App\Repositories\PostRepositoryInterface;
use Illuminate\Support\Facades\Storage;

readonly class DeletePostHandler
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    ){
    }

    public function handle(int $postId): void
    {
        $post = $this->postRepository->getPostById($postId);
        $album = $post->album;
        $post->album()->delete();
        $post->delete();

        foreach ($album as $item) {
            Storage::disk('public')->delete('posts/' . $item->file_name);
        }
    }

}
