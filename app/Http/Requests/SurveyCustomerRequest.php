<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyCustomerRequest extends FormRequest
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
            'budget' => 'required|numeric',
            'invitation_qty' => 'required|numeric|min:1',
            'event_date' => 'required',
            'province_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'theme' => 'required',
            'item_acara' => 'required',
        ];
    }
}
