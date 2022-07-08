<?php

namespace App\Http\Controllers\Api\Admin\Affiliates;

use App\Http\Controllers\Controller;
use App\Http\Resources\AffiliateResource;
use App\Models\Affiliate;
use App\Models\AffiliateLevel;
use App\Models\Role;
use App\Models\Status;
use Illuminate\Http\Request;

class ApprobationController extends Controller
{
    public function store($affiliateId)
    {
        $affiliate = Affiliate::query()->find($affiliateId);

        $level = AffiliateLevel::query()->where('start_points', 0)->first();

        $affiliate->update([
            'approved_at'   => now()->format('Y-m-d H:i'),
            'approved_by'   => auth('api')->id(),
            'status_id'     => Status::APPROVED,
            'level_id'      => $level->id ?? null,
        ]);

        $user = $affiliate->user()->create([
            'name'          => $affiliate->name.' '.$affiliate->last_name,
            'email'         => $affiliate->email,
            'password'      => $affiliate->password,
            'phone'         => $affiliate->phone,
            'affiliate_id'  => $affiliate->id,
        ]);

        $user->roles()->attach(Role::AFFILIATE);

        return new AffiliateResource($affiliate);
    }
}
