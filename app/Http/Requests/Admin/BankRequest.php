<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BankRequest extends FormRequest
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
            'name' => [
                'required',
                'max:255',
                Rule::unique('banks', 'name')->whereNull('deleted_at')->ignore($this->id)
            ],
            'description' => 'nullable|max:1000',
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
