<?php

namespace App\Http\Requests\Admin\Services;

use Illuminate\Foundation\Http\FormRequest;

class ServicesUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('services_update') ? true : false;
    }

    public function rules()
    {
        return [
            'name_en' => 'required|max:50|min:2',
            'name_ar' => 'required|max:50|min:2',
            'file.*' => 'required|mimes:jpg,jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'name_en.required' => ':attribute is required',
            'name_en.max' => ':attribute must be maximum of 50 character',
            'name_en.min' => ':attribute must be minimum of 2 character',
            'name_ar.required' => ':attribute is required',
            'name_ar.max' => ':attribute must be maximum of 50 character',
            'name_ar.min' => ':attribute must be minimum of 2 character',
            'file.*.required' => ':attribute is required',
        ];
    }

    public function attributes()
    {
        return [
            'name_en' => 'Name in English',
            'name_ar' => 'Name in Arabic',
            'file.*' => 'Image',
        ];
    }
}