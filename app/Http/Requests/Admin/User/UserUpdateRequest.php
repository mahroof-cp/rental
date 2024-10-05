<?php

namespace App\Http\Requests\Admin\User;

// use GuzzleHttp\Psr7\Request;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $email = User::where('id', $request->id)->value('email');
        if ($email == $request->email) {
            return [
                'id' => 'required',
                'name' => 'required',
                "role_id" => "required"
            ];
        } else {
            return [
                'id' => 'required',
                'name' => 'required',
                'email' => 'required|unique:users,email',
                "role_id" => "required"
            ];
        }
    }
    public function messages()
    {
        return [
            'name.required' => ':attribute is required',
            'email.required' => ':atribute is required',
            'email.unique' => ':attribute already exist',
            'password.required' => ':attribute is required',
            'password.min' => ':attribute must be minimum of 6 character',
            'password_confirm.required' => ':attribute is required',
            'role_id.required' => ':attribute is required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirm' => 'Confirm Password',
            'role_id' => 'Role'
        ];
    }
}
