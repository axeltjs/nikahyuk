<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
            'password' => 'string|required',
            'address' => 'string|required',
            'photo' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048',
            'sk_photo' => 'mimes:jpg,jpeg,png,pdf|max:3048|nullable',
            'ktp_user' => 'mimes:jpg,jpeg,png,pdf|max:3048|nullable',
            'ktp_selfie' => 'mimes:jpg,jpeg,png,pdf|max:3048|nullable',
            'phone' => 'string|min:11|max:15',
            'new_password' => 'nullable',
            'new_password2' => 'nullable|required_with:new_password',
        ];
        
        return $rules;
    }
}
