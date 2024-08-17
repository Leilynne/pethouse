<?php

namespace App\Handlers\Post;

use App\Repositories\PostRepositoryInterface;
use Illuminate\Contracts\Filesystem\Filesystem;

readonly class DeletePostHandler
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private Filesystem $filesystem,
    ){
    }

    public function handle(int $postId): void
    {
        $post = $this->postRepository->getPostById($postId);
        $album = $post->album;
        $post->album()->delete();
        $post->delete();

        foreach ($album as $item) {
            $this->filesystem->delete('posts/' . $item->file_name);
        }
    }

}
