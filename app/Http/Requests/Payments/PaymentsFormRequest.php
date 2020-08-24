<?php

namespace App\Http\Requests\Payments;

use Illuminate\Foundation\Http\FormRequest;

class PaymentsFormRequest extends FormRequest
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
            'payment_type' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'payment_type' => 'método de pago'
        ];
    }

    public function messages()
    {
        return [
            'payment_type.required' => 'Seleccione el :attribute'
        ];
    }
}
