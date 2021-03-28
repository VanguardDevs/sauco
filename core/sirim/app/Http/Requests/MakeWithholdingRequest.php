<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakeWithholdingRequest extends FormRequest
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
            'withholding_amount' => 'required|min:1'
        ];
    }

    public function messages()
    {
        return [
            'withholding_amount.required' => 'Ingrese el monto a retener',
            'withholding_amount.min' => 'El monto a retener debe ser mayor que 1'
        ];
    }
}
