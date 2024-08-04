<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Enums\UserRole;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Animal
 */
class AnimalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $response = [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'health' => $this->health,
            'description' => $this->description,
            'animal_status' => $this->animal_status,
            'sex'=> $this->sex,
            'color' => new ColorResource($this->color),
            'birthday' => $this->birthday,
            'preview' => new MediaResource($this->preview),
            'tags' => TagResource::collection($this->tags),
            'photos' => MediaResource::collection($this->photos),
        ];

        /** @var User|null $user */
        $user = $request->user();
        if (UserRole::Admin === $user?->role) {
            $response['comment'] = $this->comment;
        }

        return $response;
    }
}
