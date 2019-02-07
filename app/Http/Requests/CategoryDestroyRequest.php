<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryDestroyRequest extends FormRequest
{
    public function authorize()
    {
        return !($this->route('category') == config('cms.default_category_id'));
    }
}
