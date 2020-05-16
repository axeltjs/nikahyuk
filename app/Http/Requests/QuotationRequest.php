<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuotationRequest extends FormRequest
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
            'customer_id' => 'required',
            'package_name' => 'required|max:100',
            'file' => 'required_without:description|mimes:doc,docx,pdf|max:2048',
            'description' => 'required_without:file',
        ];
    }
}
