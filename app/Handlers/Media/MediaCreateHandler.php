<?php

declare(strict_types=1);

namespace App\Handlers\Media;

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
        \Storage::disk('public')->putFileAs('animals', $file, $filename);

        /**
         * @var Media $photo
         */
        $photo = Media::create([
            'file_name' => $filename,
            'animal_id' => $data['animal_id'],
            'primary' => false,
        ]);

        return $photo;
    }

}
