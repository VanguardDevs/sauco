<?php

namespace App\Http\Requests\Representations;

use Illuminate\Foundation\Http\FormRequest;

class RepresentationsCreateFormRequest extends FormRequest
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
            'document' => 'required|unique:representations',
            'first_name' => 'required',
            'surname' => 'required',
            'citizenship' => 'required'
        ];
    }

    public function attributes()
    {

        return [
            'document' => 'cédula',
            'first_name' => 'primer nombre',
            'surname' => 'apellido',
            'citizenship' => 'nacionalidad'
        ];
    }

    public function messages()
    {
        return [
            'document.required' => 'Ingrese la :attribute del representante',
            'document.unique' => 'Esta :attribute ya está registrada',
            'first_name.required' => 'Ingrese el :attribute',
            'surname.required' => 'Ingrese el :attribute',
            'citizenship.required' => 'Seleccione la :attribute'
        ];
    }
}
