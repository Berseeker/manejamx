<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BodyTypeRequestUpdate extends FormRequest
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
            'name' => 'required|unique:body_types,name,'.$this->body_type->id,
            'file' => 'nullable|image'
        ];
    }

    public function attributes()
    {
        return [
            'file' => 'archivo'
        ];
    }
}
