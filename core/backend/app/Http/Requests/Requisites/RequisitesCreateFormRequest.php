<?php

namespace App\Http\Requests\Requisites;

use Illuminate\Foundation\Http\FormRequest;

class RequisitesCreateFormRequest extends FormRequest
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
            'description' => 'required',
            'concept' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'description' => 'descripción',
            'concept' => 'concepto de recaudación'
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'Ingrese el :attribute',
            'concept.required' => 'Seleccione el :attribute'
        ];
    }
}
