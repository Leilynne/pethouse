<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\DTO\AnimalDTO;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin AnimalDTO
 */
class AnimalResource extends JsonResource
{

    public function __construct(AnimalDTO $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isAdmin = UserRole::Admin === $request->user()?->role;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type->value,
            'health' => $this->health->value,
            'description' => $this->description,
            'animal_status' => $this->status->value,
            'sex'=> $this->sex->value,
            'color' => new ColorResource($this->color),
            'birthday' => $this->birthday,
            'preview' => new MediaResource($this->preview),
            'tags' => TagResource::collection($this->tags),
            'photos' => MediaResource::collection($this->photos),
            'comment' => $this->when($isAdmin, $this->comment),
            'curators' => $this->when($isAdmin, UserResource::collection($this->curators)),
        ];
    }
}
