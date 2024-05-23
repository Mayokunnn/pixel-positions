<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'tag',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                $this->mergeWhen($request->routeIs('tags.*'), [
                    'createdAt' => $this->created_at,
                    'updatedAt' => $this->updated_at,
                ])
                ],
            'includes' => ['data' => JobResource::collection($this->jobs)],
            'links' => [
                'self' => route('tags.show', ['tag' => $this->id])
            ]

        ];
    }
}
