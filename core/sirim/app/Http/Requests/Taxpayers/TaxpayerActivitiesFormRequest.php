<?php

namespace App\Http\Requests\Taxpayers;

use Illuminate\Foundation\Http\FormRequest;

class TaxpayerActivitiesFormRequest extends FormRequest
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
            'economic_activities' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'economic_activities' => 'actividad económica',
        ];
    }

    public function messages()
    {
        return [
            'economic_activities.required' => 'Asigne al menos una :attribute',
        ];
    }
}
