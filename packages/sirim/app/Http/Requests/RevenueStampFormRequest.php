<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RevenueStampFormRequest extends FormRequest
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
            'date' => 'required',
            'payment_num' => 'required',
            'observations' => 'required',
            'license' => 'required',
            'amount' => 'required|numeric|min:0|not_in:0.00'
        ];
    }

    public function attributes()
    {
        return [
            'date' => 'fecha',
            'payment_num' => 'número de recibo',
            'observations' => 'concepto',
            'license' => 'licencia',
            'amount' => 'cantidad'
        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'Seleccione un :attribute',
            'payment_num.required' => 'Ingrese un :attribute',
            'observations.required' => 'Ingrese un :attribute',
            'license.required' => 'Seleccione una :attribute',
            'amount.required' => 'Ingrese una :attribute',
            'amount.numeric' => 'Ingrese una :attribute',
            'amount.min' => 'Monto debe ser mayor a cero',
            'amount.not_in' => 'Monto no debe ser cero',
        ];
    }
}