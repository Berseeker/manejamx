<?php

namespace App\Http\Controllers\Api\Admin\Affiliates;

use App\Http\Controllers\Controller;
use App\Http\Resources\AffiliateResource;
use App\Models\Affiliate;
use App\Models\Status;
use Illuminate\Http\Request;

class RejectionController extends Controller
{
    public function store($affiliateId)
    {
        $affiliate = Affiliate::query()->find($affiliateId);

        $affiliate->update([
            'rejected_at'   => now()->format('Y-m-d H:i'),
            'rejected_by'   => auth('api')->id(),
            'status_id'     => Status::REJECTED,
        ]);

        return new AffiliateResource($affiliate);
    }
}
