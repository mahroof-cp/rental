<?php

namespace App\Http\Requests\Admin\Services\facility;

use Illuminate\Foundation\Http\FormRequest;

class FacilityAddRequest extends FormRequest
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