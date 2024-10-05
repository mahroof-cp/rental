<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|max:20',
            'name' => 'required|max:255',
            'email' => [
                "required",
                "email",
                "max:255",
                Rule::unique('users', 'email')->whereNull('deleted_at')->ignore($this->id)
            ],
            'role_id' => 'nullable|max:20',
            'password' => 'nullable|string|max:255|regex:/^(?=.*?[A-Za-z0-9]).{6,}$/|confirmed',
            'password_confirmation' => 'nullable|max:255|regex:/^(?=.*?[A-Za-z0-9]).{6,}$/',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
    protected function prepareForValidation()
    {
        $data = cleanRequest($this->rules(), $this);
        $this->replace($data);
    }
}
