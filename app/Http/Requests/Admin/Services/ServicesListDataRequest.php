<?php

namespace App\Http\Requests\Admin\Services;

use Illuminate\Foundation\Http\FormRequest;

class ServicesListDataRequest extends FormRequest
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