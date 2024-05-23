<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'employer',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'logo' => $this->logo,
                $this->mergeWhen(
                    $request->routeIs(['employers.*']),
                    [
                        'createdAt' => $this->created_at,
                        'updatedAt' => $this->updated_at,
                    ]
                )
            ],
            'relationships' => [
                'author' => [
                    'data' => [
                        'type' => 'user',
                        'id' => $this->user->id
                    ]
                ],
            ],
            'links' => [
                'self' => route('employers.show', ['employer' => $this->id])
            ]
        ];
    }
}
