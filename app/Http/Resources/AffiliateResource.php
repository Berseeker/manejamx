<?php

namespace App\Http\Resources;

use App\Models\Status;
use Illuminate\Http\Resources\Json\JsonResource;

class AffiliateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                => $this->id,
            'commercial_name'   => $this->commercial_name,
            'business_name'     => $this->business_name,
            'rfc'               => $this->rfc,
            'address'           => $this->address,
            'email'             => $this->email,
            'name'              => $this->name,
            'last_name'         => $this->last_name,
            'in_process'        => $this->status_id === Status::IN_PROCESS,
            'is_rejected'       => $this->status_id === Status::REJECTED,
            'is_approved'       => $this->status_id === Status::APPROVED,
            'files'             => FileResource::collection($this->whenLoaded('files')),
            'status'            => new StatusResource($this->whenLoaded('status')),
        ];
    }
}
