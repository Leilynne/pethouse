<?php

declare(strict_types=1);

namespace App\Handlers\Post\PostUpdate;

use Illuminate\Http\UploadedFile;

readonly class PostUpdateCommand
{
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public ?UploadedFile $file,
    ) {
    }
}
