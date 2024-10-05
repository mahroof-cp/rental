<?php

namespace App\Http\Requests\Admin\Services;

use Illuminate\Foundation\Http\FormRequest;

class ServicesEditRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('Services_update') ? true : false;
    }

    public function rules()
    {
        return [
            'id' => 'required'
        ];
    }
}