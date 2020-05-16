<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'string',
            'role_id' => 'required',
            'phone' => 'string|min:11|max:15',
            'new_password' => 'nullable',
            'new_password2' => 'nullable',
        ];

        if ($this->isMethod('post')) {
            $rules['email'] .= '|unique:users';
            $rules['new_password'] .= '|required';
            $rules['new_password2'] .= '|required';
        }

        if ($this->isMethod('put')) {
            $rules['password'] .= '|required';
        }

        return $rules;
    }
}
