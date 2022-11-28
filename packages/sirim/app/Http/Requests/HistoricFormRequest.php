<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoricFormRequest extends FormRequest
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
            'concept' => 'required',
            'year' => 'required',
            'amount' => 'required|numeric|min:0|not_in:0.00'
        ];
    }

    public function attributes()
    {
        return [
            'concept' => 'concepto',
            'year' => 'periodo',
            'amount' => 'cantidad'
        ];
    }

    public function messages()
    {
        return [
            'concept.required' => 'Seleccione un :attribute',
            'year.required' => 'Seleccione un :attribute',
            'amount.required' => 'Ingrese una :attribute',
            'amount.numeric' => 'Ingrese una :attribute',
            'amount.min' => 'Monto debe ser mayor a cero',
            'amount.not_in' => 'Monto no debe ser cero',
        ];
    }
}