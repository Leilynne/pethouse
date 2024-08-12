<?php

declare(strict_types=1);

namespace App\Handlers\Media\MediaCreate;

use App\DTO\MediaDTO;
use App\Mappers\MediaMapper;
use App\Models\Media;
use Symfony\Component\Uid\Ulid;

class MediaCreateHandler
{
    public function handle(MediaCreateCommand $command): MediaDTO
    {
        $ulid = new Ulid();
        $filename = $ulid->toString() . '.' . $command->file->extension();
        \Storage::disk('public')->putFileAs($command->entityType->value, $command->file, $filename);

        /**
         * @var Media $photo
         */
        $photo = Media::create([
            'file_name' => $filename,
            'entity_id' => $command->entityId,
            'entity_type' => $command->entityType->className(),
            'primary' => false,
        ]);

        return MediaMapper::mapModelToDTO($photo);
    }

}
