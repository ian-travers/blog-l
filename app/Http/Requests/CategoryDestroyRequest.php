<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class CategoryDestroyRequest extends FormRequest
{
    public function authorize()
    {
        return !($this->route('category') == config('cms.default_category_id'));
    }

//    protected function failedAuthorization()
//    {
//        throw new AuthorizationException('У вас нет права удалить базовую категорию.');
//    }

    public function rules()
    {
        return [];
    }
}
