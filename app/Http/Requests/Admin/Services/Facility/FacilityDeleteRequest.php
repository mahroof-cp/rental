<?php

namespace App\Http\Requests\Admin\Services\Facility;

use Illuminate\Foundation\Http\FormRequest;

class FacilityDeleteRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('services_delete') ? true : false;
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