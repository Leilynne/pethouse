<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\DTO\UserDTO;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin UserDTO
 */
class UserResource extends JsonResource
{
    public function __construct(UserDTO $resource)
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
        $isAdmin = $request->user()?->role === UserRole::Admin;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'phone' => $this->phone,
            'text' => $this->when($isAdmin, $this->text)
        ];
    }
}
