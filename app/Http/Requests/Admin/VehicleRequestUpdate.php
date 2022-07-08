<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequestUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'brand_id'   => 'required',
            'model_id'   => 'required',
            'version_id' => 'required',
            'body_type_id' => 'required',
            'year'       => 'required',
            'sell_price' => 'required',
            'doors'      => 'required',
            'vin'        => 'nullable',
            'keys'       => 'nullable',
            
        ];
    }

}
