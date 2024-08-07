<?php

declare(strict_types=1);

namespace App\Handlers\Media;

use App\Enums\MediaEntityType;
use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Symfony\Component\Uid\Ulid;

class MediaCreateHandler
{
    public function handle(array $data): Media
    {
        /* @var UploadedFile $file */
        $file = $data['photo'];

        $ulid = new Ulid();
        $filename = $ulid->toString() . '.' . $file->extension();
        \Storage::disk('public')->putFileAs($data['entity_type'], $file, $filename);

        /**
         * @var Media $photo
         */
        $photo = Media::create([
            'file_name' => $filename,
            'entity_id' => $data['entity_id'],
            'entity_type' => MediaEntityType::from($data['entity_type'])->className(),
            'primary' => false,
        ]);

        return $photo;
    }

}
