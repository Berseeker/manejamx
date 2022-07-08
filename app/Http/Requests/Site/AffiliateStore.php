<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class AffiliateStore extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'commercial_name'   => 'required',
            'business_name'     => 'required',
            'rfc'               => 'required',
            'address'           => 'required',
            'name'              => 'required',
            'last_name'         => 'required',
            'email'             => ['required', 'email'],
            'phone'             => 'required',
            'password'          => ['required', 'min:6', 'max:15'],
            'address_voucher'   => ['required', 'file'],
            'identification'    => ['required', 'file'],
            'rcf_photo'         => ['required', 'file'],
        ];
    }
}
