<?php

namespace App\Http\Requests\Admin\Services\FAcility;

use Illuminate\Foundation\Http\FormRequest;

class FacilityViewRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('services_read') ? true : false;
    }

    public function rules()
    {
        return [
            'id' => 'required'
        ];
    }
}