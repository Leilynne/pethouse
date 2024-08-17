<?php

declare(strict_types=1);

namespace App\Handlers\Post\PostCreate;

use App\DTO\PostDTO;
use App\Enums\MediaEntityType;
use App\Mappers\PostMapper;
use App\Models\Media;
use App\Models\Post;
use Illuminate\Contracts\Filesystem\Filesystem;
use Symfony\Component\Uid\Ulid;

readonly class CreatePostHandler
{
    public function __construct(
        private Filesystem $filesystem,
    ) {
    }

    public function handle(PostCreateCommand $command): PostDTO
    {
        /* @var Post $post */
        $post = Post::create([
            'title' => $command->title,
            'description' => $command->description,
        ]);

        $ulid = new Ulid();
        $filename = $ulid->toString() . '.' . $command->file->extension();
        $this->filesystem->putFileAs('posts', $command->file, $filename);

        Media::create([
            'file_name' => $filename,
            'entity_id' => $post->id,
            'entity_type' => MediaEntityType::Post->className(),
            'primary' => true,
        ]);

        return PostMapper::mapModelToDTO($post);

    }

}
