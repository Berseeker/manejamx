<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AffiliateLevelResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'start_points'  => $this->start_points,
            'end_points'    => $this->end_points,
            'file'          => new FileResource($this->whenLoaded('file')),
        ];
    }
}
