<?php

namespace App\Http\Controllers\Api\Site\Affiliates;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\AffiliateStore;
use App\Http\Resources\AffiliateResource;
use App\Models\Affiliate;
use App\Models\FileType;
use App\Models\Status;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    public function show($profileUrl)
    {
        $affiliate = Affiliate::query()->where('profile_url', $profileUrl)->first();

        return new AffiliateResource($affiliate);
    }

    public function store(AffiliateStore $request)
    {
        $request->merge([
            'status_id' => Status::IN_PROCESS,
            'url'       => substr($request->name, 0, 1).$request->last_name,
        ]);

        $affiliate = Affiliate::query()->create($request->only([
            'commercial_name', 'business_name', 'rfc', 'address', 'name', 'last_name', 'email', 'phone',
            'password', 'status_id', 'url',
        ]));

        $files = [
            FileType::ID                => 'identification',
            FileType::RFC               => 'rcf_photo',
            FileType::ADDRESS_VOUCHER   => 'address_voucher',
            FileType::CONSTITUTIVE_ACT  => 'constitutive_act',
            FileType::BANK_COVER        => 'bank_cover',
        ];

        foreach ($files as $key => $value) {
            if($request->hasFile($value)) {
                $path = $request->file($value)->store('affiliates', 'public');

                $affiliate->files()->create([
                    'name'      => $request->file($value)->getClientOriginalName(),
                    'filename'  => $request->file($value)->getClientOriginalName(),
                    'path'      => $path,
                    'type_id'   => $key,
                ]);
            }
        }

        return new AffiliateResource($affiliate);
    }
}
