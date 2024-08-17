<?php

namespace App\Http\Resources;

use App\Handlers\User\UserGetCollection\UserGetCollectionResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollectionResource extends ResourceCollection
{
    private int $total;
    private int $lastPage;

    public function __construct(UserGetCollectionResponse $resource)
    {
        $this->total = $resource->total;
        $this->lastPage = $resource->lastPage;

        parent::__construct($resource->users);
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => UserResource::collection($this->resource),
            'pagination' => [
                'total' => $this->total,
                'lastPage' => $this->lastPage,
            ],
        ];
    }
}
