<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class AffiliateVehicleStore extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'brand_id'        => 'required',
            'model_id'        => 'required',
            'version_id'      => 'required',
            'year'            => 'required',
            'odometer'        => 'required',
            'sell_price'      => 'required',
            'colors'          => 'required',
            'interior_colors' => 'required',
            'file'            => ['required', 'image']
        ];
    }

    public function attributes(): array
    {
        return [
            'file'  => 'fotografía'
        ];
    }
}
