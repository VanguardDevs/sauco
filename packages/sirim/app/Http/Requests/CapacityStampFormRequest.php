<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapacityStampFormRequest extends FormRequest
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
            'capacity' => 'required|numeric',
            'license' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'capacity' => 'capacidad',
            'license' => 'licencia'
        ];
    }

    public function messages()
    {
        return [
            'capacity.required' => 'Ingrese una :attribute',
            'capacity.numeric' => 'Ingrese una :attribute',
            'license.required' => 'Seleccione una :attribute'
        ];
    }
}