<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'job',
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'salary' => $this->salary,
                'location' => $this->location,
                'schedule' => $this->schedule,
                'url' => $this->url,
                'featured' => $this->featured == 1 ? true : false,
                'tags' => $this->tags,
                $this->mergeWhen(
                    $request->routeIs(['jobs.show']),
                    [
                        'createdAt' => $this->created_at,
                        'updatedAt' => $this->updated_at,
                    ]
                )
            ],
            'relationships' => [
                'author' => [
                    'data' => [
                        'type' => 'employer',
                        'id' => $this->employer->id
                    ]
                ],
            ],
            'links' => [
                'self' => route('jobs.show', ['job' => $this->id])
            ]
        ];
    }
}
