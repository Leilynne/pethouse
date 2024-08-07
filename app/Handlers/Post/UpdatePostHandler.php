<?php

declare(strict_types=1);

namespace App\Handlers\Post;

use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\UploadedFile;
use Symfony\Component\Uid\Ulid;

readonly class UpdatePostHandler
{
    public function __construct(
        private PostRepository $postRepository,
    ){
    }

    public function handle(int $postId, array $data): Post
    {
        $post = $this->postRepository->getPostById($postId);
        $post->update($data);

        if (isset($data['preview'])) {
            /* @var UploadedFile $file */
            $file = $data['preview'];

            $ulid = new Ulid();
            $filename = $ulid->toString() . '.' . $file->extension();
            \Storage::disk('public')->putFileAs('posts', $file, $filename);

            \Storage::disk('public')->delete('posts/' . $post->preview->file_name);

            $post->preview->update([
                'file_name' => $filename,
            ]);
        }

        return $post;

    }

}
