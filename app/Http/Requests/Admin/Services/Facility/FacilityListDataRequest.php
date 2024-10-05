<?php

namespace App\Http\Requests\Admin\Services\Facility;

use Illuminate\Foundation\Http\FormRequest;

class FacilityListDataRequest extends FormRequest
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