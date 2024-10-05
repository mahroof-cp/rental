<?php

namespace App\Http\Requests\Admin\Cms;

use Illuminate\Foundation\Http\FormRequest;

class CmsSaveRequest extends FormRequest
{
    public function authorize()
    {
        return \Auth::check();
    }

    public function rules()
    {
        return [
            'name' => 'required ',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => ':attribute is required',

        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Cms name',
        ];
    }
}
