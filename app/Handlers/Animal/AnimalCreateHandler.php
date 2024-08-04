<?php

declare(strict_types=1);

namespace App\Handlers\Animal;

use App\Models\Animal;
use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Symfony\Component\Uid\Ulid;

readonly class AnimalCreateHandler
{
    /**
     * @param array<string, mixed> $data
     */
    public function handle(array $data): Animal
    {
        /* @var Animal $animal */
        $animal = Animal::create($data);
        $animal->tags()->attach($data['tags'] ?? []);

        /* @var UploadedFile $file */
        $file = $data['preview'];

        $ulid = new Ulid();
        $filename = $ulid->toString() . '.' . $file->extension();
        \Storage::disk('public')->putFileAs('animals', $file, $filename);

        Media::create([
            'file_name' => $filename,
            'animal_id' => $animal->id,
            'primary' => true,
        ]);

        return $animal;
    }
}
