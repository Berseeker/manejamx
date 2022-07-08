<?php

namespace App\Http\Controllers\Api\Admin\Affiliates;

use App\Http\Controllers\Controller;
use App\Http\Resources\AffiliateResource;
use App\Models\Affiliate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AffiliateController extends Controller
{
    public function index(): JsonResource
    {
        $affiliates = Affiliate::query()->with(['status', 'files.type'])->paginateIf();

        return AffiliateResource::collection($affiliates);
    }
}
