<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AffiliateLevelUpdate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => 'required',
            'start_points'  => 'required',
            'end_points'    => 'required',
            'file'          => ['required', 'image'],
        ];
    }

    public function attributes(): array
    {
        return [
            'file'  => 'insignia',
        ];
    }
}
