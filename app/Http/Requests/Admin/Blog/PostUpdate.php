<?php

namespace App\Http\Requests\Admin\Blog;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'         => 'required',
            'content'       => 'required',
            'file'          => ['nullable', 'image'],
            'categories'    => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'file' => 'imagen',
            'categories' => 'categorías'
        ];
    }
}
