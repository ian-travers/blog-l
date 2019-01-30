<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'category_id' => 'required',
            'body' => 'required|string',
            'published_at' => 'nullable|date_format: "Y-m-d\TH:i"',
            'image' => 'mimes:jpeg,jpg,png,gif,bmp|max:2000',
        ];
    }
}
