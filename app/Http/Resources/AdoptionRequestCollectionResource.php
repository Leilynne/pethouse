<?php

namespace App\Http\Resources;

use App\Handlers\AdoptionRequest\AdoptionRequestGetCollection\AdoptionRequestGetCollectionResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdoptionRequestCollectionResource extends ResourceCollection
{
    private int $total;
    private int $lastPage;

    public function __construct(AdoptionRequestGetCollectionResponse $resource)
    {
        $this->total = $resource->total;
        $this->lastPage = $resource->lastPage;

        parent::__construct($resource->adoptionRequests);
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => AdoptionRequestResource::collection($this->resource),
            'pagination' => [
                'total' => $this->total,
                'lastPage' => $this->lastPage,
            ],
        ];
    }
}
