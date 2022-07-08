<?php

namespace App\Http\Requests\Site;

use App\Rules\ValidRecaptcha;
use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequestStore extends FormRequest
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
            'phone'     => 'required',
            'email'     => 'required|email',
            'message'   => 'required',
            'g_recaptcha_response' => [ new ValidRecaptcha]
        ];
    }
}
