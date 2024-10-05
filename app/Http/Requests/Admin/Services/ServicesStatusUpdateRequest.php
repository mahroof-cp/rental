<?php

namespace App\Http\Requests\Admin\Services;

use Illuminate\Foundation\Http\FormRequest;

class ServicesStatusUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('services_update') ? true : false;
    }

    public function rules()
    {
        return [
            'id' => 'required',
        ];
    }

    public function messages()
    {
        return [];
    }

    public function attributes()
    {
        return [];
    }
}