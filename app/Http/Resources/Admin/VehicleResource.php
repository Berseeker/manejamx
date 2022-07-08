<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\AccessoryResource;
use App\Http\Resources\AffiliateResource;
use App\Http\Resources\BodyTypeResource;
use App\Http\Resources\BrandResource;
use App\Http\Resources\ColorResource;
use App\Http\Resources\CylinderResource;
use App\Http\Resources\DriveResource;
use App\Http\Resources\FileResource;
use App\Http\Resources\FuelResource;
use App\Http\Resources\InspectionResource;
use App\Http\Resources\TransmissionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                 => $this->id,
            'active'             => $this->active,
            'sell_price'         => $this->sell_price,
            'buy_price'          => $this->buy_price,
            'year'               => $this->year,
            'doors'              => $this->doors,
            'keys'               => $this->keys,
            'odometer'           => $this->odometer,
            'vin'                => $this->vin,
            'fuel_consumption'   => $this->fuel_consumption,
            'description'        => $this->description,
            'brand'              => new BrandResource($this->whenLoaded('brand')),
            'model'              => new ModelResource($this->whenLoaded('model')),
            'version'            => new VersionResource($this->whenLoaded('version')),
            'body_type'          => new BodyTypeResource($this->whenLoaded('body_type')),
            'status'             => new VehicleStatusResource($this->whenLoaded('status')),
            'transmissions'      => TransmissionResource::collection($this->whenLoaded('transmissions')),
            'cylinders'          => CylinderResource::collection($this->whenLoaded('cylinders')),
            'accessories'        => AccessoryResource::collection($this->whenLoaded('accessories')),
            'fuels'              => FuelResource::collection($this->whenLoaded('fuels')),
            'colors'             => ColorResource::collection($this->whenLoaded('colors')),
            'drives'             => DriveResource::collection($this->whenLoaded('drives')),
            'interior_colors'    => ColorResource::collection($this->whenLoaded('interior_colors')),
            'three_sixty_images' => FileResource::collection($this->three_sixty_images),
            'interior_images'    => FileResource::collection($this->interior_images),
            'exterior_images'    => FileResource::collection($this->exterior_images),
            'principal_images'   => FileResource::collection($this->principal_images),
            'inspections'        => InspectionResource::collection($this->whenLoaded('inspections')),
            'affiliate'          => new AffiliateResource($this->whenLoaded('affiliate')),
        ];
    }
}
