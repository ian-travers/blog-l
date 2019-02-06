<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255|unique:categories,title,' . $this->route('category'),
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $this->route('category'),
        ];
    }
}
