<?php

namespace App\Http\Resources;

use App\Http\Resources\Admin\ModelResource;
use App\Http\Resources\Admin\VersionResource;
use App\Models\Status;
use Illuminate\Http\Resources\Json\JsonResource;

class AffiliateVehicleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                => $this->id,
            'created_at'        => $this->created_at ? $this->created_at->format('d/m/Y H:i') : '',
            'year'              => $this->year,
            'odometer'          => $this->odometer,
            'sell_price'        => $this->sell_price,
            'in_process'        => $this->status_id == Status::IN_PROCESS,
            'is_approved'       => $this->status_id == Status::APPROVED,
            'is_rejected'       => $this->status_id == Status::REJECTED,
            'brand'             => new BrandResource($this->whenLoaded('brand')),
            'model'             => new ModelResource($this->whenLoaded('model')),
            'version'           => new VersionResource($this->whenLoaded('version')),
            'status'            => new StatusResource($this->whenLoaded('status')),
            'user'              => new UserResource($this->whenLoaded('user')),
            'interior_colors'   => ColorResource::collection($this->whenLoaded('interior_colors')),
            'exterior_colors'   => ColorResource::collection($this->whenLoaded('exterior_colors')),
            'files'             => FileResource::collection($this->whenLoaded('files')),
        ];
    }
}
