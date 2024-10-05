<?php

namespace App\Http\Requests\Admin\Services;

use Illuminate\Foundation\Http\FormRequest;

class ServicesListRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('services_read') ? true : false;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}