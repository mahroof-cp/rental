<?php

namespace App\Http\Requests\Admin\User;

// use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserPasswordUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'password' => 'required|min:6',
            'password_confirm' => 'required_with:password|same:password',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => ':attribute is required',
            'password.min' => ':attribute must be minimum of 6 character',
            'password_confirm.required' => ':aattribute is required',
            'password_confirm.same' => ':attribute must be same as Password',
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'Password',
            'password_confirm' => 'Confirm Password',
        ];
    }
}
