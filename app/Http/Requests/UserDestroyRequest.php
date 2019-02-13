<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDestroyRequest extends FormRequest
{
    public function authorize()
    {
        return !(($this->route('user') == config('cms.default_user_id')) || $this->route('user') == auth()->user()->id);
    }

    public function rules()
    {
        return [];
    }
}
