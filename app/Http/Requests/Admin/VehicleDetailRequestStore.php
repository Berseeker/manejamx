<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VehicleDetailRequestStore extends FormRequest
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
            'transmissions'    => 'required|array|min:1',
            'cylinders'        => 'required|array|min:1',
            'fuels'            => 'required|array|min:1',
            'colors'           => 'required|array|min:1',
            'interior_colors'  => 'required|array|min:1',
            'drives'           => 'required|array|min:1',
        ];
    }
}
