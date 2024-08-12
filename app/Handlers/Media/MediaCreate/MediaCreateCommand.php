<?php

declare(strict_types=1);

namespace App\Handlers\Media\MediaCreate;

use App\Enums\MediaEntityType;
use Illuminate\Http\UploadedFile;

readonly class MediaCreateCommand
{
    public function __construct(
        public int $entityId,
        public MediaEntityType $entityType,
        public UploadedFile $file,
    ) {
    }
}
