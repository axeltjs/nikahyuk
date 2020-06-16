<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionRequest extends FormRequest
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
        if($this->method() == 'POST'){
            return [
                'title' => 'required|string',
                'description' => 'required|string',
                'gambar' => 'required|mimes:png,jpg,jpeg,gif|max:2048',
            ];
        }else{
            return [
                'title' => 'required|string',
                'description' => 'required|string',
                'gambar' => 'nullable|mimes:png,jpg,jpeg,gif|max:2048',
            ];
        }
        
    }
}
