<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyValidateRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'constitution_date' => 'required',
            'taxpayer_id' => 'required',
            'parish_id' => 'required',
            'community_id' => 'required',
            'capital' => 'required',
            'num_workers' => 'required',
            'principal' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese un nombre para el contribuyente',
            'address.required' => 'Ingrese la dirección fiscal de la empresa',
            'principal.required' => 'Defina si es la filial principal o segundaria',
            'taxpayer_id.required' => 'Seleccione un tipo',
            'parish_id.required' => 'Seleccione un municipio',
            'community_id.required' => 'Seleccione una comunidad',
            'constitution_date.required' => 'Ingrese la fecha de constitución de la empresa',
            'capital.required' => 'Ingrese el capital de la empresa',
            'num_workers.required' => 'Ingrese el número de trabajadores de la empresa'
        ];
    }
}
