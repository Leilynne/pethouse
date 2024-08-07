<?php

declare(strict_types=1);

namespace App\Handlers\Post;

use App\Enums\MediaEntityType;
use App\Models\Media;
use App\Models\Post;
use Symfony\Component\Uid\Ulid;

readonly class CreatePostHandler
{
    public function handle(array $data): Post
    {
        /* @var Post $post */
        $post = Post::create($data);
        $file = $data['preview'];

        $ulid = new Ulid();
        $filename = $ulid->toString() . '.' . $file->extension();
        \Storage::disk('public')->putFileAs('posts', $file, $filename);

        Media::create([
            'file_name' => $filename,
            'entity_id' => $post->id,
            'entity_type' => MediaEntityType::Post->className(),
            'primary' => true,
        ]);

        return $post;

    }

}
