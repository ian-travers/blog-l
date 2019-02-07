<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->route("user"),
            'password' => 'required_with:password_confirmation|confirmed',
        ];
    }
}
