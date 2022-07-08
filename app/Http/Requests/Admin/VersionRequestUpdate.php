<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VersionRequestUpdate extends FormRequest
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
            'name'      => 'required',
            'year'      => 'required',
            'sell'      => 'required',
            'buy'       => 'required',
            'currency'  => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name'      => 'Nombre',
            'year'      => 'Año',
            'sell'      => 'P. Venta',
            'buy'       => 'P. Compra',
            'currency'  => 'Moneda',
        ];
    }
}
