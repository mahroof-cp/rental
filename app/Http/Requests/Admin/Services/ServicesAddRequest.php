<?php

namespace App\Http\Requests\Admin\Services;

use Illuminate\Foundation\Http\FormRequest;

class ServicesAddRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('services_create') ? true : false;
    }
    public function rules()
    {
        return [
            //
        ];
    }
}