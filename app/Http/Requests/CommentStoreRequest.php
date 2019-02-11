<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'author_name' => 'required|string|max:255',
            'author_email' => 'required|email|max:255',
            'author_url' => 'nullable|string|max:255',
            'body' => 'required',
        ];
    }
}
