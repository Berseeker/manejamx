<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class VehicleSellRequestStore extends FormRequest
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
        
        $rules = [
            'name'            => 'required',
            'last_name'       => 'required',
            'phone'           => 'required',
            'email'           => 'required|email',
            'brand_id'        => 'required',
            'model_id'        => 'required',
            'version_id'      => 'required',
            'year'            => 'required',
            'odometer'        => 'required',
            'sell_price'      => 'required',
            'colors'          => 'required',
            'interior_colors' => 'required',
            'file'            => 'required|image',
        ];

        if(request()->filled('register') && request()->register == 'true'){
            $rules['email'] = 'required|email|unique:users,email';
            $rules['password'] = 'required|confirmed';
        }   

        return $rules;
    }

    public function attributes()
    {
        return [
            'file'  => 'imagen', 
            'colors' => 'color exterior' 
        ];
    }
    
    public function messages()
    {
        return [
            'password.required'  => 'El campo contraseña es obligatorio cuando selecciona registrar.', 
        ];
    }
}
