<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorSetupRequest extends FormRequest
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
        return [
            'city_id' => 'required',
            'budget_min' => 'required_with:budget_max|numeric',
            'photo' => 'mimes:jpg,jpeg,png|max:2048',
            'identity_card' => 'mimes:jpg,jpeg,png,pdf|max:2048',
            'business_permit' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'theme' => 'required',
            'item_acara' => 'required',
        ];
    }
}
