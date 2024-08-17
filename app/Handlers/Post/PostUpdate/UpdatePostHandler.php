<?php

declare(strict_types=1);

namespace App\Handlers\Post\PostUpdate;

use App\DTO\PostDTO;
use App\Mappers\PostMapper;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Contracts\Filesystem\Filesystem;
use Symfony\Component\Uid\Ulid;

readonly class UpdatePostHandler
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private Filesystem $filesystem,
    ){
    }

    public function handle(PostUpdateCommand $command): PostDTO
    {
        $post = $this->postRepository->getPostById($command->id);
        $post->update([
            'title' => $command->title,
            'description' => $command->description,
        ]);

        if (isset($command->file)) {
            $ulid = new Ulid();
            $filename = $ulid->toString() . '.' . $command->file->extension();
            $this->filesystem->putFileAs('posts', $command->file, $filename);

            $this->filesystem->delete('posts/' . $post->preview->file_name);

            $post->preview->update([
                'file_name' => $filename,
            ]);
        }

        $post->load('photos');

        return PostMapper::mapModelToDTO($post);

    }

}
