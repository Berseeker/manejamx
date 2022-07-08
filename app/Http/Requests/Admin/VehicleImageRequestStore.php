<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VehicleImageRequestStore extends FormRequest
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
            'files'   => 'required|max:20',
            'files.*' => 'max:5000|image'
        ];
    }

    public function attributes()
    {
        return [
            'files' => 'Archivo'
        ];
    }

    public function messages()
    {
        $messages = [

            'files.max'  => ucfirst('No puede subir más de 20 archivos'),
            'files.*.max'  => ucfirst('El archivo no puede ser mayor a 5mb'),
            'files.*.image'  => ucfirst('El archivo debe ser una imagen'),
        ];

        return $messages;
    }
}
