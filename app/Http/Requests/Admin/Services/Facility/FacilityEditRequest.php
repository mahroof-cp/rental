<?php

namespace App\Http\Requests\Admin\Services\Facility;

use Illuminate\Foundation\Http\FormRequest;

class FacilityEditRequest extends FormRequest
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