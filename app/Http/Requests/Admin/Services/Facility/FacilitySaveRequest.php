<?php

namespace App\Http\Requests\Admin\Services\Facility;

use Illuminate\Foundation\Http\FormRequest;

class FacilitySaveRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('services_create') ? true : false;
    }

    public function rules()
    {
        return [
            'title_en' => 'required|max:50|min:2',
            'title_ar' => 'required|max:50|min:2',
        ];
    }

    public function messages()
    {
        return [
            'title_en.required' => ':attribute is required',
            'title_en.max' => ':attribute must be maximum of 50 character',
            'title_en.min' => ':attribute must be minimum of 2 character',
            'title_ar.required' => ':attribute is required',
            'title_ar.max' => ':attribute must be maximum of 50 character',
            'title_ar.min' => ':attribute must be minimum of 2 character',
        ];
    }

    public function attributes()
    {
        return [
            'title_en' => 'Title in English',
            'title_ar' => 'Title in Arabic',
        ];
    }
}