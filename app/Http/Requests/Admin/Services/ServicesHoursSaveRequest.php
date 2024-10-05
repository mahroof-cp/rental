<?php

namespace App\Http\Requests\Admin\Services;

use Illuminate\Foundation\Http\FormRequest;

class ServicesHoursSaveRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->can('services_create') ? true : false;
    }

    public function rules()
    {
        return [
            'mon' => 'required|max:50|min:2',
            'tur' => 'required|max:50|min:2',
            'wed' => 'required|max:50|min:2',
            'thus' => 'required|max:50|min:2',
            'fri' => 'required|max:50|min:2',
            'sat' => 'required|max:50|min:2',
            'sun' => 'required|max:50|min:2',
        ];
    }

    public function messages()
    {
        return [
            'mon.required' => ':attribute is required',
            'mon.max' => ':attribute must be maximum of 50 character',
            'mon.min' => ':attribute must be minimum of 2 character',
            'tur.required' => ':attribute is required',
            'tur.max' => ':attribute must be maximum of 50 character',
            'tur.min' => ':attribute must be minimum of 2 character',
            'wed.required' => ':attribute is required',
            'wed.max' => ':attribute must be maximum of 50 character',
            'wed.min' => ':attribute must be minimum of 2 character',
            'thus.required' => ':attribute is required',
            'thus.max' => ':attribute must be maximum of 50 character',
            'thus.min' => ':attribute must be minimum of 2 character',
            'fri.required' => ':attribute is required',
            'fri.max' => ':attribute must be maximum of 50 character',
            'fri.min' => ':attribute must be minimum of 2 character',
            'sat.required' => ':attribute is required',
            'sat.max' => ':attribute must be maximum of 50 character',
            'sat.min' => ':attribute must be minimum of 2 character',
            'sun.required' => ':attribute is required',
            'sun.max' => ':attribute must be maximum of 50 character',
            'sun.min' => ':attribute must be minimum of 2 character',
        ];
    }

    public function attributes()
    {
        return [
            'mon' => 'Enter the Date in Monday',
            'tur' => 'Enter the Date in Tuesday',
            'wed' => 'Enter the Date in wednesday',
            'thus'=> 'Enter the Date in Thursday',
            'fri' => 'Enter the Date in Friday',
            'sat' => 'Enter the Date in Saturday',
            'sun' => 'Enter the Date in Sunday',
        ];
    }
}