<?php

namespace App\Http\Requests\Applications;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationsCreateFormRequest extends FormRequest
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
            'ordinance' => 'required',
            'concept' => 'required' 
        ];
    }

    public function messages()
    {
        return [
            'ordinance' => 'ordenanza o licencia',
            'concept' => 'concepto de recaudación'
        ];
    }
    
    public function attributes()
    {
        return [
            'ordinance.required' => 'Seleccione la :attribute',
            'concept.required' => 'Seleccione el :attribute asociado'
        ];
    }
}
